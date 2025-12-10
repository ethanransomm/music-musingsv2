@extends('layouts.app')

@section('title', 'Create Album') 

@section('content')
    <div class="max-w-xl mx-auto p-8 bg-white shadow-xl rounded-lg mt-8">
        <h2 class="text-3xl font-extrabold text-gray-900 mb-6 border-b pb-2">Add a New Album</h2>

        @if ($errors->any())
            <div class="mb-4 p-4 text-sm text-red-800 bg-red-100 rounded-lg">
                <p class="font-bold">Please correct the following errors:</p>
                <ul class="list-disc ml-5 mt-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        
        <form method="POST" action="{{ route('albums.store') }}" class="space-y-6">
            @csrf

            <div>
                <label for="title" class="block text-sm font-medium text-gray-700">Album Title</label>
                <input type="text" name="title" id="title" required 
                       class="mt-1 block w-full rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 @error('title') border-red-500 @enderror" 
                       value="{{ old('title') }}">
                @error('title')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="artist_id" class="block text-sm font-medium text-gray-700">Artist</label>
                @if (isset($artists) && $artists->isNotEmpty())
                    <select name="artist_id" id="artist_id" required 
                            class="mt-1 block w-full py-2 px-3 border bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 @error('artist_id') border-red-500 @enderror">
                        <option value="">-- Select an Artist --</option>
                        @foreach ($artists as $artist)
                            <option value="{{ $artist->id }}" {{ old('artist_id') == $artist->id ? 'selected' : '' }}>
                                {{ $artist->artist_name }}
                            </option>
                        @endforeach
                    </select>
                @else
                    <p class="mt-1 text-sm text-red-600">No artists found. Please create an artist first.</p>
                @endif
                @error('artist_id')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label for="release_date" class="block text-sm font-medium text-gray-700">Release Date</label>
                <input type="date" name="release_date" id="release_date" 
                       class="mt-1 block w-full rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 @error('release_date') border-red-500 @enderror" 
                       value="{{ old('release_date') }}">
                @error('release_date')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
            
            <div>
                <label for="genre" class="block text-sm font-medium text-gray-700">Genre</label>
                <input type="text" name="genre" id="genre" 
                       class="mt-1 block w-full rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 @error('genre') border-red-500 @enderror" 
                       value="{{ old('genre') }}">
                @error('genre')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-between items-center pt-4">
                <input type="submit" value="Create Album" 
                       class="cursor-pointer px-4 py-2 bg-indigo-600 text-white font-semibold rounded-md hover:bg-indigo-700 transition duration-150">
                
                <a href="{{ route('albums.index') }}" 
                   class="text-gray-500 hover:text-gray-700 transition duration-150">
                    Cancel
                </a>
            </div>
        </form>
    </div>
@endsection
