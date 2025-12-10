@extends('layouts.app')

@section('content')
    @if ($albums->isEmpty())
        <p>No artists or albums found</p>
    @else
        <ul>
            @foreach ($albums as $artist)
                    <li>
                        <strong>{{ $artist->artist_name }}</strong>
                        <ul>
                            @foreach ($artist->albums as $album)
                                        <strong>
                                            <li>{{ $album->title }}
                                        </strong> ({{ $album->release_date }})
                                </li>
                                <li>{{ $album->genre }}</li>
                            @endforeach
                </ul>
                </li>
            @endforeach
        </ul>
    @endif
@endsection


</body>

</html>