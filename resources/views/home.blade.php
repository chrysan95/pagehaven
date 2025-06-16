@extends('layout')

@section('content')
<nav class="bg-transparent shadow-md">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            {{-- logo eak --}}
            <div class="flex-shrink-0">
                <a href="{{ url('/') }}" class="flex items-center space-x-2">
                    <img src="{{ asset('book.png') }}" class="h-8" alt="PageHaven Logo">
                    <span class="text-green-800 font-bold text-lg">PageHaven</span>
                </a>
            </div>
            {{-- daleman navbar --}}
            <div class="hidden md:flex items-center space-x-6">
                <a href="{{ url('/home') }}" class="text-green-800 hover:text-pink-400 px-3 py-2 rounded-md text-base font-medium">Home</a>
                <a href="{{ url('/books') }}" class="text-green-800 hover:text-pink-400 px-3 py-2 rounded-md text-base font-medium">Books</a>
            </div>
            {{-- yeah cart and logout bro--}}
            <div class="hidden md:flex items-center space-x-6">
                @php
                    $cartCount = session('cart') ? count(session('cart')) : 0;
                @endphp
                <div class="flex items-center bg-green-100 text-green-800 font-bold text-sm px-3 py-1.5 rounded-full">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                    <span>Rp{{ number_format(auth()->user()->money, 0, ',', '.') }}</span>
                </div>
                <a href="{{ route('cart.index') }}" class="relative text-green-800 hover:text-green-950">
                    <svg class="w-6 h-6 fill-current" viewBox="0 0 24 24">
                        <path d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13l-1.6 8H19m-9 0a1 1 0 100 2 1 1 0 000-2zm8 0a1 1 0 100 2 1 1 0 000-2z"/>
                    </svg>
                    @if($cartCount > 0)
                        <span class="absolute -top-2 -right-2 bg-red-600 text-white text-xs font-semibold rounded-full px-1.5 py-0.5">
                            {{ $cartCount }}
                        </span>
                    @endif
                </a>
                {{-- logout --}}
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="bg-green-800 text-white px-4 py-2 rounded-lg hover:bg-green-900">
                        Logout
                    </button>
                </form>
            </div>
            {{-- hamburger!!!! --}}
            <div class="md:hidden">
                <button id="mobile-menu-button" class="text-green-800 hover:text-green-900 focus:outline-none">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>
        </div>
    </div>
    {{-- ya mobile begitulah --}}
    <div id="mobile-menu" class="md:hidden hidden px-4 pt-2 pb-4 space-y-2">
        <a href="{{ url('/home') }}" class="block text-green-800 hover:text-pink-400">Home</a>
        <a href="{{ url('/books') }}" class="block text-green-800 hover:text-pink-400">Books</a>
        <a href="{{ route('cart.index') }}" class="block text-green-800 hover:text-pink-400">Cart</a>
        <div class="border-t border-pink-100 pt-3 mt-2">
             <span class="block font-bold text-green-800">Your Money:</span>
             <span class="block text-green-700">Rp{{ number_format(auth()->user()->money, 0, ',', '.') }}</span>
        </div>
        <form action="{{ route('logout') }}" method="POST" class="block">
            @csrf
            <button type="submit" class="w-full bg-green-800 text-white px-4 py-2 rounded hover:bg-green-900 mt-2">
                Logout
            </button>
        </form>
    </div>
</nav>


<div class="max-w-5xl mx-auto px-4 py-10">
    <h1 class="text-3xl font-bold text-green-800 mb-6">📚 Your Inventory</h1>

    @if(session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6" role="alert">
            <p>{{ session('success') }}</p>
        </div>
    @endif
    
    @if($invoiceDetails->isEmpty())
        <p class="text-green-700">You haven't purchased any books yet.</p>
    @else
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
            @foreach($invoiceDetails as $detail)
                @php $book = $detail->book; @endphp
                @if($book)
                <div class="bg-white shadow-md rounded-xl p-4 border border-pink-100 flex flex-col justify-between">
                    <div>
                        <h2 class="text-xl font-semibold text-green-800">{{ $book->title }}</h2>
                        <p class="text-green-700">Quantity: {{ $detail->quantity }}</p>
                        <p class="text-sm text-pink-400 mt-1">Purchased Value: Rp{{ number_format($detail->price * $detail->quantity, 0, ',', '.') }}</p>
                    </div>

                    <a href="{{ route('books.show', $book->id) }}"
                       class="mt-4 text-center bg-green-800 text-white font-bold text-sm px-4 py-2 rounded-lg hover:bg-green-900 transition duration-300">
                        Read Now
                    </a>
                </div>
                @endif
            @endforeach
        </div>
    @endif
</div>

<script>
    document.getElementById('mobile-menu-button').addEventListener('click', function() {
        var menu = document.getElementById('mobile-menu');
        menu.classList.toggle('hidden');
    });
</script>
@endsection