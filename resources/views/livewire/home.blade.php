<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 space-y-16">

    <div class="text-center space-y-4 py-16">
        <h1 class="text-6xl font-extrabold text-white tracking-tight mb-4">
            Music <span class="text-green-500">Musings</span>
        </h1>
        <p class="text-xl text-gray-400 max-w-2xl mx-auto">
            Browse and Rate your favorite albums with a community of music musers.
        </p>
        <div class="pt-6">
            <a href="{{ route('albums.index') }}" class="px-8 py-3 bg-green-500 text-black font-bold rounded-full hover:bg-green-400 transition transform hover:scale-105 shadow-lg inline-block">
                Dive In
            </a>
        </div>
    </div>

    <section>
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-2xl font-bold text-white">Featured Albums</h2>
            <a href="{{ route('albums.index') }}" class="text-sm font-bold text-gray-400 hover:text-white uppercase tracking-wider transition">View All</a>
        </div>
        
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
            @foreach($featuredAlbums as $album)
                <a href="{{ route('album.show', $album->id) }}" class="group block bg-gray-800 rounded-lg p-4 hover:bg-gray-700 transition duration-300">
                    <div class="aspect-square w-full bg-gray-900 rounded-md overflow-hidden mb-4 relative shadow-lg">
                        @if($album->cover_url)
                            <img src="{{ $album->cover_url }}" alt="{{ $album->title }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                        @else
                            <div class="absolute inset-0 flex items-center justify-center text-gray-700">
                                <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3"></path></svg>
                            </div>
                        @endif
                    </div>
                    <h3 class="font-bold text-white truncate group-hover:text-green-500 transition">{{ $album->title }}</h3>
                    <p class="text-sm text-gray-400 truncate">{{ $album->artist->artistName ?? 'Unknown' }}</p>
                </a>
            @endforeach
        </div>
    </section>

    <section>
        <h2 class="text-2xl font-bold text-white mb-6">Recent Reviews</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach($recentReviews as $review)
                <div class="bg-gray-800 p-6 rounded-xl border border-gray-700 hover:border-gray-600 transition">
                    <div class="flex items-center space-x-3 mb-4">
                        <div class="w-10 h-10 rounded-full bg-gradient-to-br from-green-400 to-blue-500 flex items-center justify-center text-black font-bold">
                            {{ substr($review->user->name ?? 'U', 0, 1) }}
                        </div>
                        <div>
                            <div class="text-white font-bold text-sm">{{ $review->user->name ?? 'User' }}</div>
                            <div class="text-xs text-gray-400">rated <a href="{{ route('album.show', $review->album->id) }}" class="text-green-400 hover:underline">{{ $review->album->title }}</a></div>
                        </div>
                    </div>
                    <div class="mb-4">
                        <div class="flex text-green-500 text-sm mb-2">
                            @for($i=0; $i<$review->score; $i++) ★ @endfor
                        </div>
                        <h4 class="text-gray-200 font-bold mb-1 line-clamp-1">{{ $review->title }}</h4>
                        <p class="text-gray-400 text-sm line-clamp-3 italic">"{{ $review->comment }}"</p>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    <section>
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-2xl font-bold text-white">Featured Artists</h2>
            <a href="{{ route('artists.index') }}" class="text-sm font-bold text-gray-400 hover:text-white uppercase tracking-wider transition">View All</a>
        </div>
        <div class="grid grid-cols-3 md:grid-cols-6 gap-4">
            @foreach($newArtists as $artist)
                <a href="{{ route('artist.show', $artist->id) }}" class="group text-center">
                    <div class="aspect-square rounded-full bg-gray-800 border-2 border-gray-700 group-hover:border-green-500 transition overflow-hidden mb-2 flex items-center justify-center">
                        <span class="text-2xl font-bold text-gray-600 group-hover:text-white transition">
                            {{ substr($artist->artistName, 0, 1) }}
                        </span>
                    </div>
                    <p class="text-sm text-gray-300 font-medium truncate group-hover:text-green-500 transition">{{ $artist->artistName }}</p>
                </a>
            @endforeach
        </div>
    </section>

</div>