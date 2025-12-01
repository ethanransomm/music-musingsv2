<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    
    
    <div class="flex flex-col md:flex-row justify-between items-center mb-10 gap-6">
        <div>
            <h1 class="text-3xl font-bold text-gray-900 tracking-tight">Artists</h1>
            <p class="text-gray-500 mt-1">Browse our collection of {{ $artists->total() }} artists.</p>
        </div>
         <div class="relative w-full md:w-96">
            <input wire:model.live.debounce.300ms="search" 
                   type="text" 
                   placeholder="Search for artists..."
                   class="w-full pl-12 pr-4 py-3 bg-gray-800 border border-transparent text-white placeholder-gray-500 rounded-full focus:outline-none focus:ring-2 focus:ring-green-500 focus:bg-gray-700 transition duration-200 shadow-sm text-sm font-medium">
            
            <div class="absolute left-4 top-3.5 text-gray-400">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
            </div>
        </div>
    </div>

    
    <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-8">
        @forelse($artists as $artist)
          <a href="{{ route('artist.show', $artist->id) }}" class="group flex flex-col items-center text-center">
                <div class="relative w-32 h-32 mb-4">
                    <div class="w-full h-full rounded-full overflow-hidden border-4 border-white shadow-md group-hover:shadow-lg group-hover:scale-105 transition duration-300 bg-gray-100 flex items-center justify-center">
                        <span class="text-3xl font-bold text-gray-300 group-hover:text-indigo-400 transition">
                            {{ substr($artist->artistName, 0, 1) }}
                        </span>
                        
                    </div>
                </div>

                
                <h3 class="font-bold text-white text-lg truncate group-hover:text-green-400 transition">
                    {{ $artist->artistName }}
                </h3>
                <span class="text-xs font-medium px-2 py-1 bg-gray-100 text-gray-600 rounded-full mt-2">
                    {{ $artist->albums_count }} {{ Str::plural('Album', $artist->albums_count) }}
                </span>
            </a>
        @empty
            <div class="col-span-full py-12 text-center">
                <div class="inline-block p-4 rounded-full bg-gray-100 mb-4">
                    <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                </div>
                <h3 class="text-lg font-medium text-gray-900">No artists found</h3>
                <p class="text-gray-500">Try adjusting your search terms.</p>
            </div>
        @endforelse
    </div>
    <div class="mt-10">
        {{ $artists->links() }}
    </div>
</div>