<!DOCTYPE html>
<html>

<head>
    <title>Music Musings - Albums</title>
</head>

<body>
    <h1>Albums</h1>

    @if ($albums->isEmpty())
        <p>No artists or albums found for this query. Check the URL and database data.</p>
    @else
        <ul>
            @foreach ($albums as $artist)
                <li>
                    <strong>{{ $artist->artistName }}</strong>
                    <ul>
                        @foreach ($artist->albums as $album)
                            <li>{{ $album->title }} ({{ $album->release_date }})</li>
                            <li>{{ $album->genre }}</li>
                        @endforeach
                    </ul>
                </li>
            @endforeach
        </ul>
    @endif

</body>

</html>