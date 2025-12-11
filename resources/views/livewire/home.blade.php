<div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 space-y-24">

        {{-- Hero Section --}}
        <div class="text-center space-y-6 py-24">
            <h1 class="text-7xl md:text-8xl font-black text-white tracking-tight mb-6 leading-none">
                Music <span
                    class="bg-gradient-to-r from-green-400 via-green-500 to-green-600 bg-clip-text text-transparent">Musings</span>
            </h1>
            <p class="text-2xl text-gray-300 max-w-3xl mx-auto font-light leading-relaxed">
                Browse and rate your favorite albums with a community of music enthusiasts.
            </p>
            <div class="pt-10">
                <a href="{{ route('albums.index') }}"
                    class="group relative px-10 py-4 bg-gradient-to-r from-green-500 to-green-600 text-black text-lg font-bold rounded-full hover:from-green-400 hover:to-green-500 transition-all duration-300 transform hover:scale-105 hover:shadow-2xl hover:shadow-green-500/50 inline-flex items-center space-x-2">
                    <span>Dive In</span>
                    <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform duration-300" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                    </svg>
                </a>
            </div>
        </div>

        {{-- Featured Albums Section --}}
        <section class="space-y-8">
            <div class="flex items-center justify-between pb-4 border-b border-gray-800">
                <div>
                    <h2 class="text-4xl font-bold text-white mb-2">Featured Albums</h2>
                    <p class="text-gray-400 font-light">Handpicked selections from our collection</p>
                </div>
                <a href="{{ route('albums.index') }}"
                    class="group text-sm font-semibold text-gray-400 hover:text-green-400 uppercase tracking-widest transition-all duration-300 flex items-center space-x-2">
                    <span>View All</span>
                    <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform duration-300" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </a>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
                @foreach($featuredAlbums as $album)
                    <a href="{{ route('album.show', $album->id) }}"
                        class="group block bg-gray-800/50 backdrop-blur-sm rounded-2xl p-5 hover:bg-gray-700/50 transition-all duration-300 transform hover:-translate-y-2 hover:shadow-2xl hover:shadow-green-500/10">
                        <div
                            class="aspect-square w-full bg-gray-900 rounded-xl overflow-hidden mb-5 relative shadow-xl ring-1 ring-gray-700/50 group-hover:ring-green-500/50 transition-all duration-300">
                            @if($album->cover_url)
                                <img src="{{ $album->cover_url }}" alt="{{ $album->title }}"
                                    class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                            @else
                                <div
                                    class="absolute inset-0 flex items-center justify-center text-gray-700 group-hover:text-gray-600 transition-colors duration-300">
                                    <svg class="w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                            d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3">
                                        </path>
                                    </svg>
                                </div>
                            @endif
                            <div
                                class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            </div>
                        </div>
                        <h3
                            class="font-bold text-white text-lg truncate group-hover:text-green-400 transition-colors duration-300 mb-1">
                            {{ $album->title }}
                        </h3>
                        <p class="text-sm text-gray-400 truncate font-light">{{ $album->artist->artist_name ?? 'Unknown' }}
                        </p>
                    </a>
                @endforeach
            </div>
        </section>

        <section class="space-y-8">
            <div class="flex items-center justify-between pb-4 border-b border-gray-800">
                <div>
                    <h2 class="text-4xl font-bold text-white mb-2">Recent Reviews</h2>
                    <p class="text-gray-400 font-light">Community Featured Posts</p>
                </div>
                <a href="{{ route('forum.index') }}"
                    class="group text-sm font-semibold text-gray-400 hover:text-green-400 uppercase tracking-widest transition-all duration-300 flex items-center space-x-2">
                    <span>View All</span>
                    <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform duration-300" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @foreach($recentReviews as $review)
                    <div
                        class="group bg-gray-800/50 backdrop-blur-sm p-8 rounded-2xl border border-gray-700/50 hover:border-green-500/50 transition-all duration-300 flex flex-col h-full transform hover:-translate-y-1 hover:shadow-2xl hover:shadow-green-500/10">

                        <div class="flex items-center space-x-4 mb-6">
                            <a href="{{ route('profile.show', $review->user) }}"
                                class="flex-shrink-0 transform transition-transform duration-300 hover:scale-110">
                                @if($review->user->profile->profile_picture)
                                    <img src="{{ asset('storage/' . $review->user->profile->profile_picture) }}"
                                        alt="{{ $review->user->name }}"
                                        class="w-12 h-12 rounded-full object-cover border-2 border-gray-700 group-hover:border-green-500 transition-colors duration-300 shadow-lg">
                                @else
                                    <div
                                        class="w-12 h-12 rounded-full bg-gradient-to-br from-green-400 to-blue-500 flex items-center justify-center text-black font-bold text-lg border-2 border-gray-700 group-hover:border-green-500 transition-colors duration-300 shadow-lg">
                                        {{ substr($review->user->name ?? 'U', 0, 1) }}
                                    </div>
                                @endif
                            </a>
                            <div class="flex-1 min-w-0">
                                <a href="{{ route('profile.show', $review->user) }}"
                                    class="font-semibold text-gray-200 hover:text-green-400 transition-colors duration-300 block truncate">
                                    {{ $review->user->name ?? 'Deleted User' }}
                                </a>
                                <div class="text-sm text-gray-400 font-light">
                                    rated
                                    <a href="{{ route('album.show', $review->album->id) }}"
                                        class="text-green-400 hover:text-green-300 hover:underline transition-colors duration-300">
                                        {{ $review->album->title }}
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="flex-1 space-y-4">
                            <div class="flex text-green-500 text-base space-x-0.5">
                                @for($i = 0; $i < $review->score; $i++)
                                    <span class="transform transition-transform duration-300 hover:scale-125">★</span>
                                @endfor
                            </div>

                            @if($review->title)
                                <h4 class="text-gray-100 font-bold text-lg line-clamp-1 leading-tight">
                                    {{ $review->title }}
                                </h4>
                            @endif

                            <p class="text-gray-300 text-sm line-clamp-3 leading-relaxed font-light italic">
                                "{{ $review->comment }}"</p>
                        </div>

                        <div class="mt-6 pt-4 border-t border-gray-700/50">
                            <span class="text-xs text-gray-500 font-light">{{ $review->created_at->diffForHumans() }}</span>
                        </div>

                    </div>
                @endforeach
            </div>
        </section>

        <section class="space-y-8">
            <div class="flex items-center justify-between pb-4 border-b border-gray-800">
                <div>
                    <h2 class="text-4xl font-bold text-white mb-2">Featured Artists</h2>
                    <p class="text-gray-400 font-light">Explore music from talented artists</p>
                </div>
                <a href="{{ route('artists.index') }}"
                    class="group text-sm font-semibold text-gray-400 hover:text-green-400 uppercase tracking-widest transition-all duration-300 flex items-center space-x-2">
                    <span>View All</span>
                    <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform duration-300" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </a>
            </div>

            <div class="grid grid-cols-3 md:grid-cols-6 gap-8">
                @foreach($featuredArtists as $artist)
                    <a href="{{ route('artist.show', $artist->id) }}"
                        class="group text-center transform transition-all duration-300 hover:-translate-y-3">
                        <div
                            class="aspect-square rounded-full bg-gray-800/50 backdrop-blur-sm border-4 border-gray-700 group-hover:border-green-500 transition-all duration-300 overflow-hidden mb-4 flex items-center justify-center shadow-xl group-hover:shadow-2xl group-hover:shadow-green-500/30 ring-4 ring-transparent group-hover:ring-green-500/20">
                            @if($artist->image_url)
                                <img src="{{ $artist->image_url }}" alt="{{ $artist->artist_name }}"
                                    class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                            @else
                                <span
                                    class="text-3xl font-bold text-gray-400 group-hover:text-green-400 transition-colors duration-300">
                                    {{ substr($artist->artist_name, 0, 1) }}
                                </span>
                            @endif
                        </div>
                        <p
                            class="text-sm text-gray-300 font-semibold truncate group-hover:text-green-400 transition-colors duration-300">
                            {{ $artist->artist_name }}
                        </p>
                    </a>
                @endforeach
            </div>
        </section>

    </div>
</div>