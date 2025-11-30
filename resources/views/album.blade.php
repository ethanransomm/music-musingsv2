@extends('layouts.app')

@section('content')
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-12">

        <div class="flex flex-col md:flex-row gap-10">
            <div class="w-full md:w-1/3 flex-shrink-0">
                <div class="bg-white p-4 rounded-xl shadow-sm border border-gray-100 sticky top-8">
                    <div class="aspect-square w-full bg-gray-100 rounded-lg overflow-hidden mb-6 relative shadow-inner">
                        @if($album->cover_url)
                            <img src="{{ $album->cover_url }}" alt="{{ $album->title }}" class="w-full h-full object-cover">
                        @else
                            <div class="flex items-center justify-center h-full text-gray-300">
                                <svg class="w-20 h-20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3">
                                    </path>
                                </svg>
                            </div>
                        @endif
                    </div>

                    <div class="space-y-4">
                        <div>
                            <h1 class="text-2xl font-bold text-gray-900 leading-tight">{{ $album->title }}</h1>
                            <h2 class="text-lg text-indigo-600 font-medium">
                                @if($album->artist)
                                    <a href="{{ route('artist.show', $album->artist->id) }}"
                                        class="hover:underline hover:text-indigo-800 transition cursor-pointer">
                                        {{ $album->artist->artistName }}
                                    </a>
                                @else
                                    <span class="text-gray-400">Unknown Artist</span>
                                @endif
                            </h2>
                        </div>

                        <div class="border-t border-gray-100 pt-4 space-y-2 text-sm">
                            <div class="flex justify-between">
                                <span class="text-gray-500">Released</span>
                                <span class="font-medium text-gray-900">
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
                                <span class="text-gray-500">Genre</span>
                                <span class="px-2 py-0.5 rounded text-xs font-semibold bg-gray-100 text-gray-700">
                                    {{ $album->genre }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="w-full md:w-2/3 space-y-12">

                <section>
                    <h3 class="text-xl font-bold text-gray-900 mb-4 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3">
                            </path>
                        </svg>
                        Track Listing
                    </h3>
                    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                        @if($album->songs && $album->songs->count() > 0)
                            <ul class="divide-y divide-gray-100">
                                @foreach($album->songs as $index => $song)
                                    <li class="px-4 py-3 flex items-center hover:bg-gray-50 transition">
                                        <span class="w-8 text-sm text-gray-400 font-mono">{{ $index + 1 }}</span>
                                        <span class="flex-grow text-gray-700 font-medium">{{ $song->title }}</span>
                                        <span class="text-xs text-gray-400">{{ gmdate("i:s", $song->duration) }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <div class="p-8 text-center text-gray-500 italic">
                                Tracklist data not available for this release.
                            </div>
                        @endif
                    </div>
                </section>

                <section>
                    <h3 class="text-xl font-bold text-gray-900 mb-4 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z">
                            </path>
                        </svg>
                        Rate & Review
                    </h3>

                    <div class="bg-gray-50 rounded-xl border border-gray-200 p-6">
                        <livewire:create-review :album-id="$album->id" />
                    </div>

                    <div class="mt-8 space-y-6">
                        @foreach($album->reviews ?? [] as $review)
                            <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                                <div class="flex justify-between items-start mb-2">
                                    <div class="flex items-center space-x-2">
                                        <div class="font-bold text-gray-900">{{ $review->user->name }}</div>
                                        <span class="text-gray-300">•</span>
                                        <div class="flex text-yellow-400">
                                            @for($i = 0; $i < $review->score; $i++) ★ @endfor
                                        </div>
                                    </div>
                                    <span class="text-xs text-gray-400">{{ $review->created_at->diffForHumans() }}</span>
                                </div>
                                <h4 class="font-bold text-gray-800 mb-1">{{ $review->title }}</h4>
                                <p class="text-gray-600 text-sm leading-relaxed">{{ $review->content }}</p>
                            </div>
                        @endforeach
                    </div>
                </section>
            </div>
        </div>
    </div>
@endsection