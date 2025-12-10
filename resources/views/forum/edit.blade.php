@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-white mb-2">Edit Review</h1>
        <p class="text-gray-400">Update your thoughts about this album.</p>
    </div>

    <div class="bg-gray-800 rounded-xl shadow-lg border border-gray-700 p-8">
        <form method="POST" action="{{ route('forum.update', $rate->id) }}" class="space-y-6">
            @csrf
            @method('PATCH')
            
            <div>
                <label class="block text-sm font-medium text-gray-300 mb-2">Album</label>
                <div class="flex items-center p-4 bg-gray-700 border border-gray-600 rounded-lg">
                    @if($rate->album->cover_url)
                        <img src="{{ $rate->album->cover_url }}" 
                             alt="{{ $rate->album->title }}"
                             class="w-16 h-16 rounded object-cover mr-4">
                    @else
                        <div class="w-16 h-16 rounded bg-gray-900 flex items-center justify-center mr-4">
                            <svg class="w-8 h-8 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3"></path>
                            </svg>
                        </div>
                    @endif
                    <div>
                        <p class="text-white font-bold">{{ $rate->album->title }}</p>
                        <p class="text-sm text-gray-400">{{ $rate->album->artist->artist_name ?? 'Unknown Artist' }}</p>
                    </div>
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-300 mb-2">Your Rating</label>
                <div class="flex items-center space-x-2" x-data="{ score: {{ old('score', $rate->score) }} }">
                    @for($i = 1; $i <= 10; $i++)
                        <button 
                            type="button"
                            @click="score = {{ $i }}"
                            class="text-3xl transition duration-200 hover:scale-110 focus:outline-none"
                        >
                            <span x-bind:class="score >= {{ $i }} ? 'text-green-500' : 'text-gray-600'">★</span>
                        </button>
                    @endfor
                    <span class="text-gray-400 ml-4" x-text="score + '/10'"></span>
                    <input type="hidden" name="score" x-model="score">
                </div>
                @error('score') 
                    <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="title" class="block text-sm font-medium text-gray-300 mb-2">Review Title</label>
                <input 
                    type="text" 
                    name="title"
                    id="title"
                    value="{{ old('title', $rate->title) }}"
                    placeholder="Best Album you've ever heard?"
                    maxlength="255"
                    required
                    class="w-full px-4 py-3 bg-gray-700 border border-gray-600 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition"
                >
                @error('title') 
                    <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="comment" class="block text-sm font-medium text-gray-300 mb-2">Review Content</label>
                <textarea 
                    name="comment"
                    id="comment"
                    rows="6"
                    placeholder="Share your thoughts..."
                    maxlength="2000"
                    required
                    class="w-full px-4 py-3 bg-gray-700 border border-gray-600 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition resize-none"
                >{{ old('comment', $rate->comment) }}</textarea>
                <p class="mt-2 text-xs text-gray-500" x-data="{ count: {{ strlen(old('comment', $rate->comment)) }} }">
                    <span x-text="count"></span>/2000 characters
                </p>
                @error('comment') 
                    <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center justify-between pt-4">
                <a href="{{ route('forum.index') }}" 
                   class="text-gray-400 hover:text-white transition font-medium">
                    Cancel
                </a>
                <button 
                    type="submit"
                    class="px-6 py-3 bg-green-500 text-black font-bold rounded-full hover:bg-green-400 transition transform hover:scale-105 shadow-lg"
                >
                    Update Review
                </button>
            </div>

        </form>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
@endsection