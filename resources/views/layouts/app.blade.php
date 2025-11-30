<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Music Musings @yield('title') </title>
    @livewireStyles

    <script src="https://cdn.tailwindcss.com"></script>

</head>

<body>
    <header>
        <h1> @yield('title')</h1>
        <nav>
            <a href="/home">Home</a> |
            <a href="/artists">Artists</a> |
            <a href="/albums">Albums</a> |
            <a href="/about">About</a> |
            <a href="/forum">Forum</a>

            @auth
            <div class="flex items-center space-x-3">
                <span class="text-sm font-semibold text-gray-700">Hello, {{ Auth::user()->name }}</span>
                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <button type="submit" class="text-sm text-red-500 hover:text-red-700">
                        Log Out
                    </button>
                </form>
            </div>
            @endguest
            @guest
                <div class="space-x-4">
                    <a href="{{ route('login') }}" class="text-sm text-indigo-600 hover:text-indigo-800 font-medium">Log
                        In</a>
                    <a href="{{ route('register') }}"
                        class="text-sm text-white bg-indigo-600 px-3 py-1 rounded-md hover:bg-indigo-700 transition">Register</a>
                </div>
            @endguest


        </nav>
    </header>


    <div>
    @if(isset($slot))
        {{ $slot }}
    
    @else
        @yield('content')
    @endif
</div>
    <footer>
        <p>&copy; 2025 Music Musings. All rights reserved.</p>
    </footer>

 @livewireScripts
</body>