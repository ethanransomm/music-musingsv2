<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    
    <div class="flex flex-col md:flex-row justify-between items-end mb-10 gap-6">
        
        <div class="w-full md:w-auto">
            <h1 class="text-4xl font-extrabold text-gray-100 tracking-tight mb-2">All Albums</h1>
            <p class="text-gray-400">Explore our library of {{ $albums->total() }} releases.</p>
        </div>


        <div class="relative w-full md:w-96">
            <input wire:model.live.debounce.300ms="search" 
                   type="text" 
                   placeholder="Search albums or artists..."
                   class="w-full pl-12 pr-4 py-3 bg-gray-800 border border-transparent text-gray-100 placeholder-gray-500 rounded-full focus:outline-none focus:ring-2 focus:ring-green-500 focus:bg-gray-700 transition duration-200 shadow-sm text-sm font-medium">
            
            <div class="absolute left-4 top-3.5 text-gray-400">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @forelse($albums as $album)
            <a href="{{ route('album.show', $album->id) }}"
                class="group block bg-gray-800 rounded-xl shadow-lg hover:bg-gray-700 transition duration-300 ease-in-out overflow-hidden transform hover:-translate-y-1 hover:shadow-xl">
                
                <div class="aspect-square w-full bg-gray-900 relative transition overflow-hidden">
                    @if($album->cover_url)
                        <img src="{{ $album->cover_url }}" alt="{{ $album->title }}" class="w-full h-full object-cover shadow-inner group-hover:opacity-100 opacity-90 transition duration-300">
                    @else
                        <div class="absolute inset-0 flex items-center justify-center text-gray-600 group-hover:text-gray-500 transition">
                            <svg class="w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" 
                                      d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3">
                                </path>
                            </svg>
                        </div>
                    @endif
                </div>

                <div class="p-5">
                    <h3 class="font-bold text-gray-100 text-lg truncate group-hover:text-green-400 transition">
                        {{ $album->title }}
                    </h3>
                    <p class="text-sm text-gray-400 truncate mt-1 group-hover:text-gray-300 transition">
                        {{ $album->artist->artist_name ?? 'Unknown Artist' }}
                    </p>

                    <div class="flex items-center text-xs text-gray-500 mt-4 font-mono uppercase tracking-wide">
                        <span class="bg-gray-700/50 px-2 py-1 rounded text-gray-400 border border-gray-700 group-hover:border-gray-600 transition">
                            {{ $album->genre }}
                        </span>
                        <span class="mx-auto"></span> 
                        <span>
                            @if($album->release_date_precision == 'year')
                                {{ \Carbon\Carbon::parse($album->release_date)->format('Y') }}
                            @elseif($album->release_date_precision == 'month')
                                {{ \Carbon\Carbon::parse($album->release_date)->format('M Y') }}
                            @else
                                {{ \Carbon\Carbon::parse($album->release_date)->format('Y') }}
                            @endif
                        </span>
                    </div>
                </div>
            </a>
        @empty
            <div class="col-span-full py-20 text-center">
                <div class="inline-block p-6 rounded-full bg-gray-800 mb-4 animate-pulse">
                    <svg class="w-12 h-12 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </div>
                <h3 class="text-xl font-bold text-gray-100 mb-2">No albums found</h3>
                <p class="text-gray-400">We couldn't find anything matching "{{ $search }}".</p>
            </div>
        @endforelse
    </div>

    <div class="mt-16 flex flex-col sm:flex-row items-center justify-between gap-8">
        {{ $albums->links() }} 
    </div>
</div>