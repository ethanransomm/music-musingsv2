<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="flex flex-col md:flex-row justify-between items-center mb-8 gap-4">
        <h1 class="text-3xl font-bold text-gray-900">All Albums</h1>

        <div class="relative w-full md:w-1/3">
            <input wire:model.live.debounce.300ms="search" type="text" placeholder="Search albums or artists..."
                class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500 transition shadow-sm">
            <div class="absolute left-3 top-2.5 text-gray-400">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @forelse($albums as $album)
            <a href="{{ route('album.show', $album->id) }}"
                class="group block bg-white rounded-xl shadow-sm hover:shadow-md transition duration-200 overflow-hidden border border-gray-100">
                <div class="aspect-square bg-gray-200 w-full relative group-hover:opacity-90 transition overflow-hidden">
                    @if($album->cover_url)
                        <img src="{{ $album->cover_url }}" alt="{{ $album->title }}" class="w-full h-full object-cover">
                    @else
                        <div class="absolute inset-0 flex items-center justify-center text-gray-400">
                            <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3">
                                </path>
                            </svg>
                        </div>
                    @endif
                </div>

                <div class="p-4">
                    <h3 class="font-bold text-gray-900 truncate group-hover:text-indigo-600 transition">
                        {{ $album->title }}
                    </h3>
                    <p class="text-sm text-gray-500 truncate">{{ $album->artist->artistName ?? 'Unknown Artist' }}</p>

                    <p class="text-xs text-gray-400 mt-2">
                        @if($album->release_date_precision == 'year')
                            {{ \Carbon\Carbon::parse($album->release_date)->format('Y') }}
                        @elseif($album->release_date_precision == 'month')
                            {{ \Carbon\Carbon::parse($album->release_date)->format('M Y') }}
                        @else
                            {{ $album->release_date }}
                        @endif
                        • {{ $album->genre }}
                    </p>
                </div>
            </a>
        @empty
            <div class="col-span-full text-center py-12 text-gray-500">
                No albums found matching "{{ $search }}".
            </div>
        @endforelse
    </div>

    <div class="mt-8">
        {{ $albums->links() }}
    </div>
</div>