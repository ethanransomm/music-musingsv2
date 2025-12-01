<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Music Musings @yield('title') </title>
    @livewireStyles

    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        green: {
                            400: '#a78bfa', 
                            500: '#8b5cf6', 
                            600: '#7c3aed', 
                            700: '#6d28d9',
                        },
                        indigo: {
                            400: '#a78bfa',
                            500: '#8b5cf6',
                            600: '#7c3aed',
                            700: '#6d28d9',
                        },
                        
                        gray: {
                            100: '#f9f9f9', 
                            200: '#e5e5e5', 
                            300: '#d4d4d4',
                            400: '#a3a3a3', 
                            500: '#737373', 
                            600: '#525252', 
                            700: '#282828',
                            800: '#181818', 
                            900: '#121212', 
                        }
                    }
                }
            }
        }
    </script>
</head>

<body class="bg-gray-900 text-gray-100 antialiased font-sans">
    
    <header class="bg-black/90 backdrop-blur-md border-b border-gray-800 sticky top-0 z-50">
        <nav class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between">
        
            <div class="flex items-center space-x-1">
                <a href="/home" class="text-gray-300 hover:text-white hover:bg-gray-800 px-3 py-2 rounded-md text-sm font-bold transition">Home</a>
                <a href="/artists" class="text-gray-300 hover:text-white hover:bg-gray-800 px-3 py-2 rounded-md text-sm font-bold transition">Artists</a>
                <a href="/albums" class="text-gray-300 hover:text-white hover:bg-gray-800 px-3 py-2 rounded-md text-sm font-bold transition">Albums</a>
                <a href="/forum" class="text-gray-300 hover:text-white hover:bg-gray-800 px-3 py-2 rounded-md text-sm font-bold transition">Forum</a>
            </div>

            <div class="flex items-center">
                @auth
                    <div class="flex items-center space-x-4">
                        <span class="text-sm font-bold text-gray-100">
                            {{ Auth::user()->name }}
                        </span>
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="text-xs text-gray-400 hover:text-white uppercase tracking-wider font-bold transition">
                                Log Out
                            </button>
                        </form>
                    </div>
                @endauth

                @guest
                    <div class="flex items-center space-x-4">
                        <a href="{{ route('login') }}" class="text-sm text-gray-300 hover:text-white font-bold transition uppercase tracking-wide">
                            Log In
                        </a>
                        <a href="{{ route('register') }}"
                            class="text-sm text-black bg-white hover:bg-gray-200 px-6 py-2 rounded-full font-bold transition transform hover:scale-105">
                            Sign Up
                        </a>
                    </div>
                @endguest
            </div>
        </nav>
    </header>

    <main class="min-h-screen">
        @if(isset($slot))
            {{ $slot }}
        @else
            @yield('content')
        @endif
    </main>

    <footer class="py-12 text-center border-t border-gray-800 mt-12">
        <p class="text-gray-400 text-sm">&copy; 2025 Music Musings. All rights reserved.</p>
    </footer>

    @livewireScripts
</body>
</html>