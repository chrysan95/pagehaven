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
        .nav {
            font-family: 'Lexend', sans-serif;
        }
        .logo-name {
            font-weight: bold;
            font-size: 1.5rem;
            color: #065f46; /* green-800 */
            margin-left: 0.5rem;
        }
        .navbar{
            font-size: 64px;
            font-weight: 600;
        }
    </style>
</head>
<body class="bg-gradient-to-br from-pink-300 to-pink-100 min-h-screen">

    {{-- dari sini navbarnya --}}
    <nav class="bg-transparent shadow-md">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                
                {{-- logo --}}
                <div class="flex-shrink-0">
                    <a href="{{ url('/') }}" class="flex items-center">
                        <img src="{{ asset('book.png') }}" class="h-8" alt="PageHaven Logo">
                        <span class="logo-name">PageHaven</span>
                    </a>
                </div>
                
                {{-- daleman navbar --}}
                <div class="hidden md:block">
                    <div class="flex items-center space-x-4" id="navbar">
                        <a href="#home" class="text-green-700 hover:text-pink-400 px-3 py-2 rounded-md text-16px font-medium transition-colors duration-200">Home</a>
                        <a href="#features" class="text-green-700 hover:hover:text-pink-400 px-3 py-2 rounded-md text-16px font-medium transition-colors duration-200">Features</a>
                        <a href="{{ url('/books') }}" class="text-green-700 hover:text-pink-400 px-3 py-2 rounded-md text-16px font-medium transition-colors duration-200">Books</a>
                        <a href="{{ url('/login') }}" class="bg-pink-300 hover:bg-pink-400 hover:text-white text-green-700 px-3 py-2 rounded-full text-16px font-medium transition-colors duration-300">
                            Login
                        </a>
                    </div>
                </div>
                
                {{-- hamburg --}}
                <div class="md:hidden">
                    <button id="mobile-menu-button" class="text-gray-700 hover:text-green-700 focus:outline-none">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
        
        {{-- daleman hamburg --}}
        <div id="mobile-menu" class="md:hidden hidden">
            <div class="px-2 pt-2 pb-3 space-y-1 bg-gray-50">
                <a href="#home" class="text-gray-700 hover:text-green-700 block px-3 py-2 rounded-md text-base font-medium">Home</a>
                <a href="#features" class="text-gray-700 hover:text-green-700 block px-3 py-2 rounded-md text-base font-medium">Features</a>
                <a href="{{ url('/books') }}" class="text-gray-700 hover:text-green-700 block px-3 py-2 rounded-md text-base font-medium">Books</a>
                <a href="{{ url('/login') }}" class="bg-pink-300 hover:bg-pink-400 hover:text-white text-green-700 px-4 py-2 rounded font-medium block text-center mt-2">
                    Login
                </a>
            </div>
        </div>
    </nav>


    <div class="bg-gradient-to-br from-pink-300 to-pink-100 min-h-screen"> 
        {{-- hero section --}}
        <section id="home" class="flex items-center justify-center min-h-screen px-4">
            <div class="text-center max-w-4xl w-full">
                <h1 class="text-transparent bg-clip-text bg-gradient-to-r from-green-800 to-green-600 mb-4 text-4xl md:text-6xl lg:text-7xl font-bold leading-tight">
                    So many platforms, but no better deal on books?
                </h1>
                <p class="text-green-700 text-lg md:text-xl mb-8">
                    <span class="text-pink-400">PageHaven</span> is here to enlarge your knowledge and book collection starting from Rp 10.000
                </p>
                <a href="{{ url('/books') }}"
                    class="bg-gradient-to-br from-pink-400 to-pink-300 hover:from-pink-300 hover:to-pink-500 text-green-800 px-6 py-3 rounded-full text-lg font-semibold shadow-md hover:shadow-lg transition-all duration-300 transform hover:scale-105">
                    Explore Books
                </a>                  
            </div>
        </section>
        {{-- fitur fitur --}}
        <section id="features" class="py-24 relative">
            <div class="max-w-7xl mx-auto px-6">
                <h2 class="text-4xl font-bold text-center text-green-800 mb-16">
                    Why Choose PageHaven?
                </h2>

                <div class="grid gap-10 sm:grid-cols-2 lg:grid-cols-3">
                    @php
                        $features = [
                            ['icon' => '⚡️', 'title' => 'Fast Access', 'desc' => 'Quickly browse and purchase books with our responsive and user-friendly system.'],
                            ['icon' => '📚', 'title' => 'Extensive Categories', 'desc' => 'From fiction and business to academic references, all in one platform.'],
                            ['icon' => '🔐', 'title' => 'Secure Transactions', 'desc' => 'Your purchases and personal data are protected with advanced encryption.'],
                            ['icon' => '📱', 'title' => 'Mobile Optimized', 'desc' => 'Enjoy a smooth browsing experience from any device, anytime.'],
                            ['icon' => '💳', 'title' => 'Flexible Payments', 'desc' => 'Support for bank transfers, e-wallets, and even installment options.'],
                            ['icon' => '🤝', 'title' => 'Customer Support', 'desc' => 'Our team is ready to assist you with any questions or issues.'],
                        ];
                    @endphp

                    @foreach ($features as $feature)
                    <div class="relative overflow-hidden rounded-2xl border border-pink-300/40 bg-white/30 backdrop-blur-md p-8 text-center transition-all duration-300 hover:shadow-2xl hover:-translate-y-2 hover:border-pink-500">
                        <div class="text-4xl mb-4">{{ $feature['icon'] }}</div>
                        <h3 class="text-xl font-semibold text-pink-400 mb-2">{{ $feature['title'] }}</h3>
                        <p class="text-green-800 leading-relaxed">{{ $feature['desc'] }}</p>
                        <div class="absolute top-0 left-[-100%] w-full h-full bg-gradient-to-r from-transparent via-purple-200/40 to-transparent pointer-events-none transition-all duration-500 ease-in-out hover:left-[100%]"></div>
                    </div>
                    @endforeach
                </div>
            </div>
        </section>
    </div>

    <footer class="bg-green-800 shadow-md py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <p class="text-pink-300 text-sm mb-2">
                &copy; {{ date('Y') }} PageHaven. All rights reserved. 
            </p>
        </div>
    </footer>

    <script>
        const mobileMenuButton = document.getElementById('mobile-menu-button');
        const mobileMenu = document.getElementById('mobile-menu');
        
        if (mobileMenuButton && mobileMenu) {
            mobileMenuButton.addEventListener('click', () => {
                mobileMenu.classList.toggle('hidden');
            });
        }
    </script>
</body>
</html>