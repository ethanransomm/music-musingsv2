<!DOCTYPE html>
<html>

<head>
    <title>All Artists</title>
</head>

<body>
    <h1>All Artists</h1>

    @if ($artists->isEmpty())
        <p>No artists found in the database.</p>
    @else
        <ul>
            @foreach ($artists as $artist)
                <li>
                    <strong><a href="/artist/{{ rawurlencode($artist->artistName) }}">
                            {{ $artist->artistName }} </a></strong>
                </li>
            @endforeach
        </ul>
    @endif
</body>

</html>