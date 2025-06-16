@extends('layout')

@section('content')
<div class="max-w-5xl mx-auto px-4 py-10">
    <h1 class="text-3xl font-bold text-green-800 mb-10 text-center">📊 Admin Dashboard</h1>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-white shadow-lg rounded-2xl p-6 text-center border border-pink-100">
            <h2 class="text-xl font-semibold text-pink-400 mb-2">Total Books</h2>
            <p class="text-3xl font-bold text-green-800">{{ $bookCount }}</p>
        </div>
        <div class="bg-white shadow-lg rounded-2xl p-6 text-center border border-pink-100">
            <h2 class="text-xl font-semibold text-pink-400 mb-2">Total Users</h2>
            <p class="text-3xl font-bold text-green-800">{{ $userCount }}</p>
        </div>
        <div class="bg-white shadow-lg rounded-2xl p-6 text-center border border-pink-100">
            <h2 class="text-xl font-semibold text-pink-400 mb-2">Total Invoices</h2>
            <p class="text-3xl font-bold text-green-800">{{ $invoiceCount }}</p>
        </div>
    </div>

    <div class="mt-12 text-center">
        <a href="{{ route('books.index') }}"
           class="bg-gradient-to-br from-pink-300 to-pink-400 hover:from-pink-400 hover:to-pink-500 text-green-900 font-semibold py-3 px-8 rounded-full shadow-md hover:shadow-xl transition-transform transform hover:scale-105">
            📚 Manage Books
        </a>
    </div>

    <div class="mt-16">
        <h2 class="text-2xl font-bold text-green-800 mb-6">👥 Registered Users</h2>
        <div class="overflow-x-auto bg-white shadow-lg rounded-2xl border border-pink-100">
            <table class="min-w-full divide-y divide-pink-200">
                <thead class="bg-pink-100 text-green-900">
                    <tr>
                        <th class="px-6 py-3 text-left text-sm font-semibold">Name</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold">Username</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold">Role</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-pink-100 text-green-800">
                    @foreach($users as $user)
                        <tr>
                            <td class="px-6 py-4">{{ $user->name }}</td>
                            <td class="px-6 py-4">{{ $user->username }}</td>
                            <td class="px-6 py-4 capitalize">{{ $user->role }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-16">
        <h2 class="text-2xl font-bold text-green-800 mb-6">🧾 Recent Invoices</h2>
        <div class="overflow-x-auto bg-white shadow-lg rounded-2xl border border-pink-100">
            <table class="min-w-full divide-y divide-pink-200">
                <thead class="bg-pink-100 text-green-900">
                    <tr>
                        <th class="px-6 py-3 text-left text-sm font-semibold">Invoice ID</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold">User</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold">Total</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold">Date</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-pink-100 text-green-800">
                    @foreach($invoices as $invoice)
                        <tr>
                            <td class="px-6 py-4">{{ $invoice->id }}</td>
                            <td class="px-6 py-4">{{ $invoice->user->name }}</td>
                            <td class="px-6 py-4">Rp {{ number_format($invoice->total, 0, ',', '.') }}</td>
                            <td class="px-6 py-4">{{ $invoice->created_at->format('d M Y') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
