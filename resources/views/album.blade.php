@extends('layouts.app')

@section('content')
    <div class="max-w-3xl mx-auto p-8 bg-white shadow-2xl rounded-xl mt-8">
        
        <div class="flex items-start space-x-6">
            <div class="flex-shrink-0">
                <div class="w-48 h-48 bg-gray-200 rounded-lg shadow-md flex items-center justify-center text-gray-500 text-sm">
                    Album Cover
                </div>
            </div>
            <div>
                <p class="text-4xl font-extrabold text-gray-900 mb-1">{{ $album->title }}</p>
                
                <p class="text-xl text-indigo-600 font-semibold mb-3">
                    By: 
                    <a href="{{ route('artist.show', ['artistName' => $album->artist->artistName]) }}" class="hover:underline">
                        {{ $album->artist->artistName }}
                    </a>
                </p>
                
                <p class="text-gray-600">Released: {{ $album->release_date }}</p>
                <p class="text-gray-600">Genre: {{ $album->genre }}</p>
            </div>
        </div>

        <h2 class="text-2xl font-bold mt-8 mb-4 border-b pb-2">Track List</h2>

         <ul class="space-y-1"> 
            @foreach ($album->songs as $index => $song)
                <li class="flex justify-between items-center py-2 px-3 border-b last:border-b-0 hover:bg-gray-50 transition duration-150 rounded-md">
                    <span class="font-medium text-gray-700">
                        {{ $index + 1 }}. {{ preg_replace('/^\d+\.\s*/', '', $song->title) }} 
                    </span>
                    <span class="text-sm text-gray-500">
                        {{ gmdate("i:s", $song->duration) }}
                    </span>
                </li>
            @endforeach
        </ul>

    </div>
@endsection
