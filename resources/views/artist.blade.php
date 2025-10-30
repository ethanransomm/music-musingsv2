<html>
    <head>
        <title>Music Musings - Albums</title>
    </head>
    <body>
        <h1>Albums</h1>
        <ul>
            @foreach ($Album as $artist) 
                {{-- Access the 'name' property directly on the Artist object --}}
                <li><strong>{{ $artist->artistName }}</strong>
                    <ul>
                        @foreach ($artist->albums as $album)
                            <li>{{ $album->title }} ({{ $album->release_year }})</li>
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

