@extends('layout')

@section('content')
<div class="max-w-4xl mx-auto px-4 py-10">
    <div class="mb-6">
        <a href="{{ url('/admin/dashboard') }}" class="bg-gradient-to-br from-green-950 to-emerald-900 hover:from-emerald-900 hover:to-green-950 text-pink-300 px-6 py-3 rounded-full text-lg font-semibold shadow-md hover:shadow-lg transition-all duration-300 transform hover:scale-105">
            ← Back to Dashboard
        </a>

    </div>

    <h1 class="text-3xl font-bold text-green-800 mb-6">Category Management</h1>

    @if(session('success'))
        <div class="bg-green-100 text-green-800 px-4 py-3 rounded mb-4 shadow">
            {{ session('success') }}
        </div>
    @endif

    
    <form action="{{ route('categories.store') }}" method="POST" class="bg-white rounded-lg p-6 shadow border border-pink-100 mb-8">
        @csrf
        <div class="flex flex-col md:flex-row md:items-center gap-4">
            <input type="text" name="name" placeholder="New Category Name"
                   class="flex-1 px-4 py-2 border border-pink-200 rounded-md focus:outline-none focus:ring-2 focus:ring-pink-400"
                   required>
            <button type="submit"
                    class="bg-pink-400 hover:bg-pink-500 text-white font-semibold px-6 py-2 rounded-md shadow transition duration-300">
                + Add
            </button>
        </div>
        @error('name')
            <p class="text-pink-600 text-sm mt-2">{{ $message }}</p>
        @enderror
    </form>

    {{-- Category List --}}
    <div class="bg-white rounded-lg shadow border border-pink-100 p-6">
        <h2 class="text-xl font-semibold text-green-800 mb-4">📋 Category List</h2>
        @if($categories->isEmpty())
            <p class="text-pink-400">No categories found.</p>
        @else
            <ul class="space-y-4">
                @foreach($categories as $category)
                    <li class="flex justify-between items-center border-b border-pink-100 pb-2">
                        <form action="{{ route('categories.update', $category) }}" method="POST" class="flex items-center gap-2">
                            @csrf
                            @method('PUT')
                            <input name="name" value="{{ $category->name }}"
                                   class="px-3 py-1 border border-green-200 rounded-md focus:outline-none focus:ring-2 focus:ring-green-400"
                                   required>
                            <button type="submit" class="text-sm text-green-700 hover:text-green-900 font-semibold">Save</button>
                        </form>
                        <form action="{{ route('categories.destroy', $category) }}" method="POST"
                              onsubmit="return confirm('Delete this category?');">
                            @csrf
                            @method('DELETE')
                            <button class="text-sm text-pink-500 hover:text-pink-700 font-semibold">Delete</button>
                        </form>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>
</div>
@endsection
