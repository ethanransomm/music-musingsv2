<!DOCTYPE html>
<html>

<head>
    <title>Music Musings - Albums</title>
</head>

<body>
    <h1>Albums</h1>

    @if ($albums->isEmpty())
        <p>No artists or albums found</p>
    @else
        <ul>
            @foreach ($albums as $artist)
                <li>
                    <strong>{{ $artist->artistName }}</strong>
                    <ul>
                        @foreach ($artist->albums as $album)
                            <strong><li>{{ $album->title }} </strong> ({{ $album->release_date }})</li>
                            <li>{{ $album->genre }}</li>
                            @foreach ($album->songs as $song)
                                <li>
                                {{ $song->title }} - Duration:
                                {{ gmdate("i:s", $song->duration) }}
                                </li>
                            @endforeach
                        @endforeach
                    </ul>
                </li>
            @endforeach
        </ul>
    @endif

</body>

</html>