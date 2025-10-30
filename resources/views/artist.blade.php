<html>
    <head>
        <title>Artists' Albums</title>
    </head>
    <body>
        <h1>Artists' Albums</h1>
        <ul>
            @foreach ($Albums as $artist) 
                {{-- Access the 'name' property directly on the Artist object --}}
                <li><strong>{{ $artist->name }}</strong>
                    <ul>
                        @foreach ($artist->albums as $album)
                            <li>{{ $album->title }} ({{ $album->release_year }})</li>
                        @endforeach
                    </ul>
                </li>
            @endforeach
        </ul>
        
        @if ($Albums->isEmpty())
            <li>No artists or albums found for this query. Check the URL and database data.</li>
        @endif
    </body>
</html>

