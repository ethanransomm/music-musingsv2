@extends('layouts.app')
@section('title', 'Add a new review for an Album')
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

            <div>
                <button type="submit" 
                        class="w-full bg-indigo-600 text-white py-2 px-4 rounded-md hover:bg-indigo-700 transition">

@endsection
