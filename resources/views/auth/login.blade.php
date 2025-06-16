<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PageHaven</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@100..900&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .body {
            font-family: 'Lexend', sans-serif;
        }
    </style>
</head>
<body class="bg-gradient-to-br from-pink-300 to-pink-100 min-h-screen">

    <section class="min-h-screen flex items-center justify-center relative">
        <div class="absolute inset-0  opacity-60 z-0"></div>

        <div class="relative z-10 w-full max-w-md bg-white/30 backdrop-blur-md rounded-2xl p-10 border border-pink-300/40 shadow-lg">
            <h2 class="text-3xl font-bold text-center text-green-800 mb-6">Welcome Back!</h2>

            @if(session('success'))
                <div class="mb-4 text-green-600 font-semibold text-sm">
                    {{ session('success') }}
                </div>
            @endif

            @if($errors->any())
                <div class="mb-4 text-red-600 text-sm">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>• {{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('login.post') }}" method="POST" class="space-y-6">
                @csrf
                <div>
                    <label for="username" class="block text-green-700 font-medium mb-1">Username</label>
                    <input type="text" name="username" id="username" class="w-full px-4 py-2 rounded-lg border border-pink-300 focus:outline-none focus:ring-2 focus:ring-pink-500 bg-white/60 text-green-900" required>
                </div>

                <div>
                    <label for="password" class="block text-green-700 font-medium mb-1">Password</label>
                    <input type="password" name="password" id="password" class="w-full px-4 py-2 rounded-lg border border-pink-300 focus:outline-none focus:ring-2 focus:ring-pink-500 bg-white/60 text-green-900" required>
                </div>

                <button type="submit" class="w-full bg-pink-400 hover:bg-pink-500 text-white font-semibold py-2 rounded-lg transition-all duration-300">
                    Login
                </button>
            </form>

            <p class="mt-6 text-center text-green-800 text-sm">
                Don't have an account?
                <a href="{{ route('register') }}" class="text-pink-500 hover:underline font-semibold">Register</a>
            </p>
        </div>
    </section>
</body>