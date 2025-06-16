<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\InvoiceHeader;
use App\Models\InvoiceDetail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class PurchaseController extends Controller
{
    /**
     * Handle the "Buy Now" action for a single book.
     */
    public function buyNow(Request $request, $bookId)
    {
        $user = Auth::user();
        $book = Book::findOrFail($bookId);

        // CHANGE 1: Check against the 'money' column instead of 'balance'
        if ($user->money < $book->price) {
            return redirect()->back()->with('error', 'Insufficient funds to complete the purchase.');
        }

        try {
            DB::transaction(function () use ($user, $book) {
                // CHANGE 2: Use decrement on the 'money' column
                $user->decrement('money', $book->price);

                $invoiceHeader = InvoiceHeader::create([
                    'user_id'        => $user->id,
                    'invoice_number' => 'INV-' . time() . '-' . Str::upper(Str::random(4)),
                    'total'          => $book->price,
                    'status'         => 'paid'
                ]);

                InvoiceDetail::create([
                    'invoice_header_id' => $invoiceHeader->id,
                    'book_id'           => $book->id,
                    'quantity'          => 1,
                    'price'             => $book->price,
                ]);
            });
        } catch (\Exception $e) {
            Log::error('Buy Now failed: ' . $e->getMessage());
            return redirect()->back()->with('error', 'An unexpected error occurred. Please try again.');
        }

        return redirect()->route('home')->with('success', 'Thank you! Your purchase was successful.');
    }

    /**
     * Handle the checkout process for the entire cart.
     */
    public function checkout()
    {
        $user = Auth::user();
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }

        $bookIds = array_keys($cart);
        $books = Book::find($bookIds)->keyBy('id');

        $total = 0;
        foreach ($cart as $id => $details) {
            if(isset($books[$id])) {
                $total += $books[$id]->price * $details['quantity'];
            }
        }

        // CHANGE 3: Check against the 'money' column
        if ($user->money < $total) {
            return redirect()->route('cart.index')->with('error', 'Insufficient funds.');
        }

        try {
            DB::transaction(function () use ($user, $cart, $total, $books) {
                // CHANGE 4: Use decrement on the 'money' column
                $user->decrement('money', $total);

                $invoiceHeader = InvoiceHeader::create([
                    'user_id'        => $user->id,
                    'invoice_number' => 'INV-' . time() . '-' . Str::upper(Str::random(4)),
                    'total'          => $total,
                    'status'         => 'paid'
                ]);

                foreach ($cart as $id => $details) {
                    if (isset($books[$id])) {
                        InvoiceDetail::create([
                            'invoice_header_id' => $invoiceHeader->id,
                            'book_id'           => $id,
                            'quantity'          => $details['quantity'],
                            'price'             => $books[$id]->price,
                        ]);
                    }
                }
            });
        } catch (\Exception $e) {
            Log::error('Checkout failed: ' . $e->getMessage());
            return redirect()->back()->with('error', 'An unexpected error occurred. Please try again.');
        }

        session()->forget('cart');
        return redirect()->route('home')->with('success', 'Checkout successful! Your new books are in your inventory.');
    }
}