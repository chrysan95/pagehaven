<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\User;
use App\Models\InvoiceHeader;  

class AdminController extends Controller
{
    public function dashboard()
    {
        $bookCount = Book::count();
        $userCount = User::where('role', 'user')->count();
        $invoiceCount = InvoiceHeader::count();
        
        return view('admin.dashboard', [
        'bookCount' => Book::count(),
        'userCount' => User::count(),
        'invoiceCount' => InvoiceHeader::count(),
        'users' => User::latest()->take(10)->get(), 
        'invoices' => InvoiceHeader::with('user')->latest()->take(10)->get(), 
    ]);
    }
}
