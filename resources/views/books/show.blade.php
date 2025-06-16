@extends('layout')

@section('content')
<div class="max-w-4xl mx-auto px-4 py-10">
    <div class="mb-6">
        <a href="{{ url('/books') }}" class="bg-pink-200 hover:bg-pink-300 text-green-800 px-4 py-2 rounded-full transition duration-300">
            ← Back to Book List
        </a>
    </div>

    <div class="bg-white rounded-lg shadow p-6 border border-pink-100">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

            <div class="md:col-span-1">
                @if($book->image)
                    <img src="{{ asset('storage/' . $book->image) }}" alt="Book Cover" class="w-full h-auto rounded-lg shadow-md">
                @else
                  <div class="w-full h-96 bg-pink-100 rounded-lg flex items-center justify-center">
                        <span class="text-green-800">No Image</span>
                    </div>
                @endif
            </div>

            <div class="md:col-span-2">
                <h1 class="text-3xl font-bold text-green-800 mb-2">{{ $book->title }}</h1>
                <p class="text-lg text-pink-600 mb-1"><strong>Author:</strong> {{ $book->author }}</p>
                <p class="text-lg text-pink-600 mb-1"><strong>Category:</strong> {{ $book->category->name ?? 'Uncategorized' }}</p>

                <div class="my-4">
                    <h2 class="text-green-800 font-semibold mb-2 text-xl">📖 Description</h2>
                    <p class="text-pink-700 leading-relaxed">{{ $book->description ?: 'No description available.' }}</p>
                </div>

                <div class="mt-4 text-sm text-pink-500">
                    <p><strong>Publisher:</strong> {{ $book->publisher }}</p>
                    <p><strong>Pages:</strong> {{ $book->number_of_pages }}</p>
                </div>

                <div class="mt-6 border-t border-pink-100 pt-4">
                    <p class="text-3xl font-bold text-green-800 mb-4">Rp{{ number_format($book->price, 0, ',', '.') }}</p>

                    @auth
                        @if(auth()->user()->role === 'user')

                            {{-- check if user own --}}
                            @php
                                $isOwned = auth()->user()->invoiceDetails()->where('book_id', $book->id)->exists();
                            @endphp

                            @if($isOwned)
                                {{-- user own --}}
                                <div class="p-3 bg-green-100 text-green-800 font-semibold rounded-lg text-center">
                                    ✓ You already own this book.
                                    <a href="{{ route('home') }}" class="block text-sm underline hover:text-pink-600 mt-1">View in Your Inventory</a>
                                </div>
                            @else
                                {{-- user no own --}}
                                <div class="flex items-center space-x-4">
                                    <form action="{{ route('buy.now', $book->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="w-full sm:w-auto bg-green-800 text-white font-bold py-3 px-6 rounded-lg hover:bg-green-900 transition duration-300">
                                            Buy Now
                                        </button>
                                    </form>

                                    <form action="{{ route('cart.add', $book->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="w-full sm:w-auto bg-pink-500 text-white font-bold py-3 px-6 rounded-lg hover:bg-pink-600 transition duration-300">
                                            Add to Cart
                                        </button>
                                    </form>
                                </div>
                            @endif

                        @elseif(auth()->user()->role === 'admin')
                            <div class="mt-2">
                                <a href="{{ route('books.edit', $book->id) }}" class="inline-block bg-yellow-400 text-yellow-900 font-bold py-2 px-4 rounded-lg hover:bg-yellow-500 transition duration-300">
                                    ✏️ Edit Book
                                </a>
                            </div>
                        @endif
                    @endauth
                </div>
            </div>
        </div>
    </div>
</div>
@endsection