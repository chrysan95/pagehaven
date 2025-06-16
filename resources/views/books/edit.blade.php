@extends('layout')

@section('content')
<div class="max-w-xl mx-auto px-4 py-10">
    <div class="mb-6">
        <a href="{{ url('/admin/dashboard') }}" class="bg-gradient-to-br from-green-950 to-emerald-900 hover:from-emerald-900 hover:to-green-950 text-pink-300 px-6 py-3 rounded-full text-lg font-semibold shadow-md hover:shadow-lg transition-all duration-300 transform hover:scale-105">
            ← Back to Dashboard
        </a>
    </div>

    <h1 class="text-3xl font-bold text-green-800 mb-6">Edit Book</h1>

    <form method="POST" action="{{ route('books.update', $book->id) }}" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')

        <div>
            <label class="block text-green-800">Title</label>
            <input type="text" name="title" value="{{ $book->title }}" class="w-full rounded-lg border-pink-300 focus:ring-pink-400" required>
        </div>

        <div>
            <label class="block text-green-800">Category</label>
            <select name="category_id" class="w-full rounded-lg border-pink-300 focus:ring-pink-400" required>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ $book->category_id == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block text-green-800">Author</label>
            <input type="text" name="author" value="{{ $book->author }}" class="w-full rounded-lg border-pink-300 focus:ring-pink-400" required>
        </div>

        <div>
            <label class="block text-green-800">Publisher</label>
            <input type="text" name="publisher" value="{{ $book->publisher }}" class="w-full rounded-lg border-pink-300 focus:ring-pink-400" required>
        </div>

        <div>
            <label class="block text-green-800">Price</label>
            <input type="number" name="price" value="{{ $book->price }}" class="w-full rounded-lg border-pink-300 focus:ring-pink-400" required>
        </div>

        <div>
            <label class="block text-green-800">Number of Pages</label>
            <input type="number" name="number_of_pages" value="{{ $book->number_of_pages }}" class="w-full rounded-lg border-pink-300 focus:ring-pink-400" required>
        </div>

        <div>
            <label class="block text-green-800">Description</label>
            <textarea name="description" class="w-full rounded-lg border-pink-300 focus:ring-pink-400" required>{{ $book->description }}</textarea>
        </div>

        <div>
            <label class="block text-green-800">Change Image (optional)</label>
            <input type="file" name="image" class="w-full text-pink-700">
            @if ($book->image)
                <div class="mt-2">
                    <p class="text-green-700 text-sm mb-1">Current Image:</p>
                    <img src="{{ asset('storage/' . $book->image) }}" alt="Book Cover" class="w-32 rounded">
                </div>
            @endif
        </div>

        <button type="submit" class="bg-gradient-to-br from-pink-400 to-pink-300 hover:from-pink-300 hover:to-pink-500 text-green-800 px-6 py-3 rounded-full text-lg font-semibold shadow-md hover:shadow-lg transition-all duration-300 transform hover:scale-105">
            Save Changes
        </button>
    </form>
</div>
@endsection
