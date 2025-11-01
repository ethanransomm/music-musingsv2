<!DOCTYPE html>
<html lang ="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Music Musings @yield('title') </title>
</head>
<body>
    <header>
        <h1> @yield('title')</h1>
        <nav>
            <a href="/home">Home</a> |
            <a href="/artists">Artists</a> |
            <a href="/albums">Albums</a> |
            <a href="/about">About</a>


        </nav>
    </header>
    <div>
    @yield('content')
    </div>>
    <footer>
        <p>&copy; 2025 Music Musings. All rights reserved.</p>
    </footer>


</body>

