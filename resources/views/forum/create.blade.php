@extends('layouts.app')
@section('content')
    <div class="max-w-2xl mx-auto p-8 bg-white shadow-xl rounded-lg mt-8">
        <h2 class="text-3xl font-extrabold text-gray-900 mb-6 border-b pb-2">Add a New Album Review</h2>

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
        
        <form method="POST" action="{{ route('forum.store') }}" class="space-y-6">
            @csrf

            <div>
                <label for="album_id" class="block text-sm font-medium text-gray-700">Album</label>
                @if (isset($albums) && $albums->isNotEmpty())
                    <select name="album_id" id="album_id" required
                            class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 @error('album_id') border-red-500 @enderror">
                        <option value="">-- Select an Album to Review --</option>
                        @foreach ($albums as $album)
                            <option value="{{ $album->id }}" {{ old('album_id') == $album->id ? 'selected' : '' }}>
                                {{ $album->title }}@if(isset($album->artist) && $album->artist->name) — {{ $album->artist->name }}@endif
                            </option>
                        @endforeach
                    </select>
                @else
                    <select disabled class="mt-1 block w-full py-2 px-3 border border-gray-200 bg-gray-100 rounded-md shadow-sm">
                        <option>No albums available. Please add an album first.</option>
                    </select>
                @endif

                @error('album_id')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>


            <div>
                <label for="title" class="block text-sm font-medium text-gray-700">Review Title</label>
                <input type="text" name="title" id="title" required 
                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 @error('title') border-red-500 @enderror" 
                       value="{{ old('title') }}">
                @error('title')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="content" class="block text-sm font-medium text-gray-700">Review Content</label>
                <textarea name="content" id="content" rows="5" required 
                          class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 @error('content') border-red-500 @enderror">{{ old('content') }}</textarea>
                @error('content')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

           <div class="flex justify-between items-center pt-4">
                <input type="submit" value="Add Review" 
                       class="cursor-pointer px-4 py-2 bg-indigo-600 text-white font-semibold rounded-md hover:bg-indigo-700 transition duration-150">
@endsection
