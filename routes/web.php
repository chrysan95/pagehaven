<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Authentication;
use App\Http\Controllers\BookController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;  
use App\Http\Controllers\CartController;
use App\Http\Controllers\PurchaseController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/book', function () {
    return view('book');
});

Route::get('/home', function () {
    return view('home');
})->middleware('auth');

Route::middleware(['admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
});
Route::middleware(['admin'])->group(function () {
    Route::resource('books', BookController::class)->except(['index', 'show']);
});
Route::middleware(['admin'])->group(function () {
    Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
    Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
    Route::put('/categories/{category}', [CategoryController::class, 'update'])->name('categories.update');
    Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');
});

Route::resource('books', BookController::class);
Route::get('/books', [BookController::class, 'index'])->name('books.index');
Route::get('/books/{id}', [BookController::class, 'show'])->name('books.show');
Route::resource('categories', CategoryController::class)->middleware('admin');

// Cart
Route::middleware('auth')->group(function () {
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add/{bookId}', [CartController::class, 'add'])->name('cart.add');
    Route::delete('/cart/remove/{bookId}', [CartController::class, 'remove'])->name('cart.remove');
    Route::post('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');

    // Purchase
    Route::post('/buy-now/{bookId}', [PurchaseController::class, 'buyNow'])->name('buy.now');
    Route::post('/checkout', [PurchaseController::class, 'checkout'])->name('checkout');

    Route::patch('/cart/update/{bookId}', [CartController::class, 'update'])->name('cart.update');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/home', [Authentication::class, 'home'])->name('home');
});


Route::get('/login', [Authentication::class, 'login'])->name('login');
Route::post('/login', [Authentication::class, 'loginPost'])->name('login.post'); 
Route::get('/register', [Authentication::class, 'register'])->name('register'); 
Route::post('/register', [Authentication::class, 'registerPost'])->name('register.post');
Route::post('/logout', [Authentication::class, 'logout'])->name('logout');

