<div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">

        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-12 gap-8">
            <div class="space-y-3">
                <h1 class="text-5xl font-black text-gray-100 tracking-tight">Artists</h1>
                <p class="text-gray-400 text-lg font-light">Browse our collection of <span
                        class="text-green-400 font-semibold">{{ $artists->total() }}</span> artists.</p>
            </div>
            <div class="relative w-full md:w-96">
                <input wire:model.live.debounce.300ms="search" type="text" placeholder="Search albums or artists..."
                    class="w-full pl-12 pr-4 py-3 bg-gray-800 border border-transparent text-gray-100 placeholder-gray-500 rounded-full focus:outline-none focus:ring-2 focus:ring-green-500 focus:bg-gray-700 transition duration-200 shadow-sm text-sm font-medium">
                <div class="absolute left-4 top-3.5 text-gray-400">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-10">
            @forelse($artists as $artist)
                <a href="{{ route('artist.show', $artist->id) }}"
                    class="group flex flex-col items-center text-center transform transition-all duration-300 hover:-translate-y-3">
                    <div class="relative w-36 h-36 mb-5">
                        <div
                            class="w-full h-full rounded-full overflow-hidden border-4 border-gray-700 group-hover:border-green-500 shadow-xl group-hover:shadow-2xl group-hover:shadow-green-500/30 transition-all duration-300 bg-gray-800 flex items-center justify-center ring-4 ring-transparent group-hover:ring-green-500/20">
                            @if($artist->image_url)
                                <img src="{{ $artist->image_url }}" alt="{{ $artist->artist_name }}"
                                    class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                            @else
                                <span
                                    class="text-4xl font-bold text-gray-400 group-hover:text-green-400 transition-colors duration-300">
                                    {{ substr($artist->artist_name, 0, 1) }}
                                </span>
                            @endif
                        </div>
                    </div>
                    <h3
                        class="font-bold text-gray-100 text-lg truncate w-full group-hover:text-green-400 transition-colors duration-300 mb-2">
                        {{ $artist->artist_name }}
                    </h3>
                    <span
                        class="text-xs font-semibold px-4 py-2 bg-gray-800/50 backdrop-blur-sm text-gray-400 border border-gray-700 rounded-full group-hover:border-green-500 group-hover:text-green-400 group-hover:bg-gray-800 transition-all duration-300 shadow-lg">
                        {{ $artist->albums_count }} {{ Str::plural('Album', $artist->albums_count) }}
                    </span>
                </a>
            @empty
                <div class="col-span-full py-20 text-center">
                    <div class="inline-block p-6 rounded-full bg-gray-800/50 backdrop-blur-sm mb-6 animate-pulse">
                        <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z">
                            </path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-100 mb-2">No artists found</h3>
                    <p class="text-gray-400 font-light">Try adjusting your search terms.</p>
                </div>
            @endforelse
        </div>

        <div class="mt-16">
            {{ $artists->links() }}
        </div>
    </div>
</div>