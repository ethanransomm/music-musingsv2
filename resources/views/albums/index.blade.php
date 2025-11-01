@extends('layouts.app')

@section('content')


    <h1>All Albums</h1>
        <ul>
            @foreach ($albums as $album)
                <li>
                    <strong><a href="/album/{{ rawurlencode($album->title) }}">
                            {{ $album->title }} </a></strong>
            @endforeach
        </ul>

        <a href= "{{ route('albums.create') }}">Add an Album </a>
@endsection