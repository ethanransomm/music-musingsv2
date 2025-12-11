@extends('layouts.app')

@section('content')
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-12">

        <div class="flex flex-col md:flex-row gap-10">
            <div class="w-full md:w-1/3 flex-shrink-0">
                <div class="bg-gray-800 p-4 rounded-xl shadow-lg border border-gray-700 sticky top-24">
                    <div class="aspect-square w-full bg-gray-900 rounded-lg overflow-hidden mb-6 relative shadow-md">
                        @if($album->cover_url)
                            <img src="{{ $album->cover_url }}" alt="{{ $album->title }}" class="w-full h-full object-cover">
                        @else
                            <div class="flex items-center justify-center h-full text-gray-600">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                    stroke="currentColor" class="w-20 h-20">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="m9 9 10.5-3m0 6.553v3.75a2.25 2.25 0 0 1-1.632 2.163l-1.32.377a1.803 1.803 0 1 1-.99-3.467l2.31-.66a2.25 2.25 0 0 0 1.632-2.163Zm0 0V2.25L9 5.25v10.303m0 0v3.75a2.25 2.25 0 0 1-1.632 2.163l-1.32.377a1.803 1.803 0 0 1-.99-3.467l2.31-.66A2.25 2.25 0 0 0 9 15.553Z" />
                                </svg>
                                </svg>
                            </div>
                        @endif
                    </div>

                    <div class="space-y-4">
                        <div>
                            <h1 class="text-2xl font-bold text-white leading-tight">{{ $album->title }}</h1>
                            <h2 class="text-lg text-green-500 font-medium hover:text-green-400 transition">
                                @if($album->artist)
                                    <a href="{{ route('artist.show', $album->artist->id) }}">
                                        {{ $album->artist->artist_name }}
                                    </a>
                                @else
                                    <span class="text-gray-500">Unknown Artist</span>
                                @endif
                            </h2>
                        </div>

                        <div class="border-t border-gray-700 pt-4 space-y-2 text-sm">
                            <div class="flex justify-between">
                                <span class="text-gray-400">Released</span>
                                <span class="font-medium text-gray-200">
                                    @if($album->release_date_precision == 'year')
                                        {{ \Carbon\Carbon::parse($album->release_date)->format('Y') }}
                                    @elseif($album->release_date_precision == 'month')
                                        {{ \Carbon\Carbon::parse($album->release_date)->format('M Y') }}
                                    @else
                                        {{ \Carbon\Carbon::parse($album->release_date)->format('M d, Y') }}
                                    @endif
                                </span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-400">Genre</span>
                                <span
                                    class="px-2 py-0.5 rounded text-xs font-semibold bg-gray-700 text-gray-300 border border-gray-600">
                                    {{ $album->genre }}
                                </span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-400">Favourites</span>
                                <span class="font-medium text-gray-200">
                                    {{ $album->favouritedBy()->count() }}
                                </span>
                            </div>
                        </div>
                        @auth
                                    <div class="border-t border-gray-700 pt-4">
                                        <form action="{{ route('favorites.toggle', $album) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="w-full px-4 py-2.5 rounded-lg font-semibold transition-all duration-200 shadow-md hover:shadow-lg
                                @if($album->isFavouritedBy(auth()->user()))
                                    bg-red-600 hover:bg-red-700 text-white
                                @else
                                    bg-purple-600 hover:bg-purple-700 text-white
                                @endif
                            ">
                                                @if($album->isFavouritedBy(auth()->user()))
                                                    ❤️ Remove from Favorites
                                                @else
                                                    🤍 Add to Favorites
                                                @endif
                                            </button>
                                        </form>
                                    </div>
                        @endauth
                    </div>
                </div>
            </div>


            <div class="w-full md:w-2/3 space-y-8">
                <section>
                    <div class="bg-gray-800 rounded-xl shadow-lg border border-gray-700 overflow-hidden">
                        <div class="px-6 py-4 border-b border-gray-700 flex items-center">
                            <svg class="w-5 h-5 mr-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3">
                                </path>
                            </svg>
                            <h3 class="text-lg font-bold text-white">Track Listing</h3>
                        </div>

                        @if($album->songs && $album->songs->count() > 0)
                            <ul class="divide-y divide-gray-700">
                                @foreach($album->songs as $index => $song)
                                    <li class="px-4 py-3 flex items-center hover:bg-gray-700/50 transition group">
                                        <span
                                            class="w-8 text-sm text-gray-500 font-mono group-hover:text-green-500">{{ $index + 1 }}</span>
                                        <span
                                            class="flex-grow text-gray-200 font-medium group-hover:text-white">{{ $song->title }}</span>
                                        <span class="text-xs text-gray-500 font-mono">{{ gmdate("i:s", $song->duration) }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <div class="p-12 text-center text-gray-500 italic">
                                Tracklist data not available for this release.
                            </div>
                        @endif
                    </div>
                </section>
            </div>
        </div>
    </div>
@endsection