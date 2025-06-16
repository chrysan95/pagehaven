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
    <section class="min-h-screen flex items-center justify-center px-4 py-12">
    <div class="w-full max-w-md bg-white/40 backdrop-blur-lg p-10 rounded-2xl border border-pink-300 shadow-lg">
        <h2 class="text-3xl font-bold text-center text-green-800 mb-6">Join Us at PageHaven</h2>
        {{-- error msg --}}
        @if ($errors->any()) 
            <div class="bg-red-100 border border-red-300 text-red-700 p-4 rounded mb-4 text-sm">
                <ul class="list-disc pl-5 space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

            <form method="POST" action="{{ route('register.post') }}" class="space-y-5">
                @csrf

                <div>
                    <label for="name" class="block text-green-700 font-medium">Full Name</label>
                    <input type="text" name="name" id="name" required
                        class="w-full px-4 py-2 rounded-lg border border-pink-200 focus:ring-2 focus:ring-pink-300 focus:outline-none bg-white/60 text-green-900" />
                </div>

                <div>
                    <label for="username" class="block text-green-700 font-medium">Username</label>
                    <input type="text" name="username" id="username" required class="w-full px-4 py-2 rounded-lg border border-pink-200 focus:ring-2 focus:ring-pink-300 focus:outline-none bg-white/60 text-green-900" />
                </div>

                <div>
                    <label for="password" class="block text-green-700  font-medium">Password</label>
                    <input type="password" name="password" id="password" required class="w-full px-4 py-2 rounded-lg border border-pink-200 focus:ring-2 focus:ring-pink-300 focus:outline-none bg-white/60 text-green-900" />
                </div>

                <div>
                    <label for="password_confirmation" class="block text-green-700  font-medium">Confirm Password</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" required class="w-full px-4 py-2 rounded-lg border border-pink-200 focus:ring-2 focus:ring-pink-300 focus:outline-none bg-white/60 text-green-900" />
                </div>

                <button type="submit" class="w-full bg-pink-400 hover:bg-pink-500 text-white py-2 rounded-lg transition duration-300 font-semibold">
                    Register
                </button>
            </form>

            <p class="mt-4 text-center text-green-700 text-sm">
                Already have an account?
                <a href="{{ route('login') }}" class="text-pink-600 hover:underline font-semibold">Login here</a>
            </p>
        </div>
    </section>
</body>