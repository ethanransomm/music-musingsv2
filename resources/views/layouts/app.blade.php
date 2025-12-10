<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Music Musings @yield('title') </title>
    @livewireStyles
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-900 text-gray-100 antialiased font-sans">

    <header class="bg-black/90 backdrop-blur-md border-b border-gray-800 sticky top-0 z-50">
        <nav class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between">

            <div class="flex items-center space-x-1">
                <a href="/home"
                    class="text-gray-100 hover:text-green-400 hover:bg-gray-800 px-3 py-2 rounded-md text-sm font-bold transition">Home</a>
                <a href="/artists"
                    class="text-gray-100 hover:text-green-400 hover:bg-gray-800 px-3 py-2 rounded-md text-sm font-bold transition">Artists</a>
                <a href="/albums"
                    class="text-gray-100 hover:text-green-400 hover:bg-gray-800 px-3 py-2 rounded-md text-sm font-bold transition">Albums</a>
                <a href="/forum"
                    class="text-gray-100 hover:text-green-400 hover:bg-gray-800 px-3 py-2 rounded-md text-sm font-bold transition">Forum</a>
            </div>
            <div class="flex items-center gap-6">
                @auth
                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open"
                            class="relative p-1 rounded-full text-gray-400 hover:text-white focus:outline-none transition">
                            <span class="sr-only">View notifications</span>
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                            </svg>

                            @if(auth()->user()->unreadNotifications->count() > 0)
                                <span
                                    class="absolute top-0 right-0 inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-white transform translate-x-1/4 -translate-y-1/4 bg-green-600 rounded-full">
                                    {{ auth()->user()->unreadNotifications->count() }}
                                </span>
                            @endif
                        </button>

                        <div x-show="open" @click.away="open = false" x-transition:enter="transition ease-out duration-100"
                            x-transition:enter-start="transform opacity-0 scale-95"
                            x-transition:enter-end="transform opacity-100 scale-100"
                            class="absolute right-0 mt-2 w-80 bg-gray-800 rounded-md shadow-lg py-1 z-50 border border-gray-700 origin-top-right"
                            style="display: none;">

                            @if(auth()->user()->unreadNotifications->count() > 0)
                                <div class="px-4 py-2 border-b border-gray-700 flex justify-between items-center">
                                    <span class="text-sm font-semibold text-gray-200">Notifications</span>
                                    <form action="{{ route('mark-as-read') }}" method="POST">
                                        @csrf
                                        <button type="submit"
                                            class="text-xs text-green-400 hover:text-green-300 font-bold uppercase">
                                            Mark all read
                                        </button>
                                    </form>
                                </div>
                            @else
                                <div class="px-4 py-2 text-sm text-gray-500">No new notifications</div>
                            @endif

                            <div class="max-h-64 overflow-y-auto">
                                @foreach(auth()->user()->unreadNotifications as $notification)
                                    <a href="{{ $notification->data['url'] ?? '#' }}"
                                        class="block px-4 py-3 hover:bg-gray-700 transition border-b border-gray-700 last:border-0">
                                        <p class="text-sm text-gray-300">{{ $notification->data['message'] }}</p>
                                        <p class="text-xs text-gray-500 mt-1">{{ $notification->created_at->diffForHumans() }}
                                        </p>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endauth

                <div class="flex items-center">
                    @auth
                        <div class="flex items-center space-x-4">
                            <span class="text-sm font-bold text-gray-100">
                                <a href="{{ route('profile.show', Auth::user()) }}" class="text-sm font-bold text-gray-100
                                    hover:text-green-400 transition">
                                    Hello, {{ Auth::user()->name }}
                                </a>
                            </span>
                            <form method="POST" action="{{ route('logout') }}" class="inline">
                                @csrf
                                <button type="submit"
                                    class="text-xs text-gray-400 hover:text-white uppercase tracking-wider font-bold transition">
                                    Log Out
                                </button>
                            </form>
                        </div>
                    @endauth

                    @guest
                        <div class="flex items-center space-x-4">
                            <a href="{{ route('login') }}"
                                class="text-sm text-gray-300 hover:text-green-400 font-bold transition uppercase tracking-wide">
                                Log In
                            </a>
                            <a href="{{ route('register') }}"
                                class="text-sm text-gray-300 hover:text-green-400 font-bold transition uppercase tracking-wide">
                                Sign Up
                            </a>
                        </div>
                    @endguest
                </div>
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