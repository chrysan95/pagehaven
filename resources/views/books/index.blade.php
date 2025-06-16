@extends('layout')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-10">
    <div class="mb-6">
        <a href="{{ url('/admin/dashboard') }}" class="bg-gradient-to-br from-green-950 to-emerald-900 hover:from-emerald-900 hover:to-green-950 text-pink-300 px-6 py-3 rounded-full text-lg font-semibold shadow-md hover:shadow-lg transition-all duration-300 transform hover:scale-105">
            ← Back
        </a>
    </div>
    <h1 class="text-3xl font-bold text-green-800 mb-6">All Books</h1>
    @auth
        @if(auth()->user()->role === 'admin')
            <div class="flex gap-4 mb-6">
                <a href="{{ route('books.create') }}" class="bg-gradient-to-br from-pink-400 to-pink-300 hover:from-pink-300 hover:to-pink-500 text-green-800 px-6 py-3 rounded-full text-lg font-semibold shadow-md hover:shadow-lg transition-all duration-300 transform hover:scale-105">+ Add Book</a>
                <a href="{{ route('categories.index') }}" class="bg-gradient-to-br from-green-950 to-emerald-900 hover:from-emerald-900 hover:to-green-950 text-pink-300 px-6 py-3 rounded-full text-lg font-semibold shadow-md hover:shadow-lg transition-all duration-300 transform hover:scale-105">📂 Manage Categories</a>
            </div>
        @endif
    @endauth
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach ($books as $book)
        <div class="bg-white rounded-xl p-6 shadow hover:shadow-lg border border-pink-100">
            <h2 class="text-xl font-semibold text-pink-500 mb-2">{{ $book->title }}</h2>
            <p class="text-green-700 mb-4">by {{ $book->author }}</p>
            <a href="{{ route('books.show', $book->id) }}" class="text-sm text-pink-400 hover:text-pink-600 underline">View Details</a>
        </div>
        @endforeach
    </div>
</div>
@endsection
