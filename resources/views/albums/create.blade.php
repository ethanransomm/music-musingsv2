@extends('layouts.app')

@section('title', 'Create Album')

@section('content')
    <h2>Create a New Album</h2>
    <form method="POST" action="{{ route('albums.store') }}">
        @csrf
        <p>Title: <input type="text" name="title"></p>
        <p>Release Date: <input type="text" name="release_date"></p>
        <p>Genre: <input type="text" name="genre"></p>
        <p>Artist ID: <input type="text" name="artist_id"></p>
        <input type="submit" value="Create Album">
        <a href=" {{ route('albums.index') }} ">Cancel</a>
    </form>
    

@endsection