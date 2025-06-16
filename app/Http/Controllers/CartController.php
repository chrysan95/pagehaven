<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;


class CartController extends Controller
{
    public function index()
    {
        $total = 0; // Initialize total
        $cart = session()->get('cart', []);
        $bookIds = array_keys($cart);
        $books = Book::find($bookIds)->keyBy('id');

        if (!empty($cart) && $books->isNotEmpty()) {
            foreach ($cart as $id => $details) {
                if (isset($books[$id])) {
                    $total += $books[$id]->price * $details['quantity'];
                }
            }
        }

        return view('cart.index', compact('cart', 'books', 'total'));
    }

    public function add(Request $request, $bookId)
    {
        $cart = session()->get('cart', []);

        if(isset($cart[$bookId])) {
            $cart[$bookId]['quantity']++;
        } else {
            $cart[$bookId] = ["quantity" => 1];
        }

        session()->put('cart', $cart);
        return redirect()->route('cart.index')->with('success', 'Book added to cart!');
    }

    public function update(Request $request, $bookId)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1'
        ]);

        $cart = session()->get('cart');

        if(isset($cart[$bookId])) {
            $cart[$bookId]['quantity'] = $request->quantity;
            session()->put('cart', $cart);
        }

        return redirect()->route('cart.index')->with('success', 'Cart updated successfully!');
    }


    public function remove($bookId)
    {
        $cart = session()->get('cart', []);
        
        if(isset($cart[$bookId])) {
            unset($cart[$bookId]);
            session()->put('cart', $cart);
        }

        return redirect()->route('cart.index')->with('success', 'Book removed from cart.');
    }

    public function clear()
    {
        session()->forget('cart');
        return redirect()->route('cart.index')->with('success', 'Cart cleared.');
    }
}