@extends('layouts.app')
@section('All Artists')

@section('content')

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

@endsection