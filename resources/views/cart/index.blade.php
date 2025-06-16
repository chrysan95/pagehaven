@extends('layout')

@section('content')
<div class="max-w-5xl mx-auto px-4 py-10">
    <h1 class="text-3xl font-bold text-green-800 mb-6">🛒 Your Shopping Cart</h1>

    @if(session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6" role="alert">
            <p>{{ session('success') }}</p>
        </div>
    @endif
    
    @if(empty($cart))
        <div class="bg-white shadow-md rounded-lg p-6 text-center">
            <p class="text-green-700 text-lg">Your cart is empty.</p>
            <a href="{{ route('books.index') }}" class="mt-4 inline-block bg-pink-500 text-white font-bold py-2 px-4 rounded-lg hover:bg-pink-600 transition duration-300">
                Continue Shopping
            </a>
        </div>
    @else
        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <table class="min-w-full">
                <thead class="bg-pink-100">
                    <tr>
                        <th class="text-left py-3 px-4 font-semibold text-green-800">Product</th>
                        <th class="text-left py-3 px-4 font-semibold text-green-800">Price</th>
                        <th class="text-left py-3 px-4 font-semibold text-green-800 w-32">Quantity</th>
                        <th class="text-left py-3 px-4 font-semibold text-green-800">Subtotal</th>
                        <th class="text-left py-3 px-4 font-semibold text-green-800"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($cart as $id => $details)
                        @php $book = $books[$id] ?? null; @endphp
                        @if($book)
                        <tr class="border-b border-pink-100">
                            <td class="py-4 px-4 flex items-center">
                                <img src="{{ asset('storage/' . $book->image) }}" alt="{{ $book->title }}" class="w-16 h-24 object-cover rounded mr-4">
                                <div>
                                    <a href="{{ route('books.show', $book->id) }}" class="font-semibold text-green-800 hover:text-pink-600">{{ $book->title }}</a>
                                    <p class="text-sm text-pink-500">{{ $book->author }}</p>
                                </div>
                            </td>
                            <td class="py-4 px-4 text-green-700">Rp{{ number_format($book->price) }}</td>
                            <td class="py-4 px-4">
                                <form action="{{ route('cart.update', $book->id) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <input type="number" name="quantity" value="{{ $details['quantity'] }}" min="1" class="w-20 border border-pink-300 rounded text-center">
                                    <button type="submit" class="text-xs text-pink-500 hover:underline">Update</button>
                                </form>
                            </td>
                            <td class="py-4 px-4 text-green-700">Rp{{ number_format($book->price * $details['quantity']) }}</td>
                            <td class="py-4 px-4">
                                <form action="{{ route('cart.remove', $book->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-red-700 font-semibold">Remove</button>
                                </form>
                            </td>
                        </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-6 flex justify-between items-center">
            <div>
                <form action="{{ route('cart.clear') }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600">Clear Cart</button>
                </form>
            </div>
            <div class="text-right">
                <p class="text-2xl font-bold text-green-800">Total: Rp{{ number_format($total) }}</p>
                <form action="{{ route('checkout') }}" method="POST" class="mt-2">
                    @csrf
                    <button type="submit" class="w-full bg-green-800 text-white font-bold py-3 px-6 rounded-lg hover:bg-green-900 transition duration-300">
                        Proceed to Checkout
                    </button>
                </form>
            </div>
        </div>
    @endif
</div>
@endsection