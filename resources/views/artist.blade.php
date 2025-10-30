<html>
    <head>
        <title>Music Musings - Albums</title>
    </head>
    <body>
        <h1>Albums</h1>
        <ul>
            @foreach ($albums as $artists) 
                {{-- Access the 'name' property directly on the Artist object --}}
                <li><strong>{{ $artists->artistName }}</strong>
                    <ul>
                        @foreach ($artists->album as $album)
                            <li>{{ $album->title }} ({{ $album->release_year }})</li>
                            <li>Genre: {{ $album->genre }}</li>
                        @endforeach
                    </ul>
                </li>
            @endforeach
        </ul>
        
        @if ($Album->isEmpty())
            <li>No artists or albums found for this query. Check the URL and database data.</li>
        @endif
    </body>
</html>

