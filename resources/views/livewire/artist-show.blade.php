<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">

    <div class="flex flex-col items-center justify-center text-center mb-16">
        <div
            class="w-32 h-32 rounded-full bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center text-white text-4xl font-bold shadow-lg mb-6">
            {{ substr($artist->artistName, 0, 1) }}
        </div>
        <h1 class="text-4xl font-extrabold text-gray-900 tracking-tight mb-2">{{ $artist->artistName }}</h1>
        <p class="text-gray-500 text-lg">{{ $artist->albums->count() }} Releases in Database</p>
    </div>

    <div>
        <h2 class="text-2xl font-bold text-gray-100 mb-6 border-b border-gray-100 pb-2">Discography</h2>

        <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-6">
           
            @forelse($artist->albums as $album)
                <a href="{{ route('album.show', $album->id) }}"
                    class="group block bg-gray-800 rounded-xl p-4 shadow-sm hover:bg-gray-700 transition duration-200"> 

                    <div class="aspect-square w-full bg-gray-900 rounded-lg overflow-hidden shadow-inner mb-3 relative">
                        @if($album->cover_url)
                            <img src="{{ $album->cover_url }}"
                                class="w-full h-full object-cover group-hover:opacity-90 transition">
                        @else
                            <div class="absolute inset-0 flex items-center justify-center text-gray-600">
                                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3">
                                    </path>
                                </svg>
                            </div>
                        @endif
                    </div>

                    <h3 class="font-bold text-white text-lg truncate group-hover:text-green-400 transition">
                        {{ $album->title }}
                    </h3>
                    <p class="text-xs text-gray-400 mt-1">
                        {{ \Carbon\Carbon::parse($album->release_date)->format('Y') }}
                    </p>
                </a>
            @empty
                <p class="col-span-full text-center text-gray-500 italic">No albums found.</p>
            @endforelse
        </div>
    </div>
</div>