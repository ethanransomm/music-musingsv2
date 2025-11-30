<div class="max-w-2xl mx-auto p-8 bg-gray-800 shadow-xl rounded-lg mt-8 border border-gray-700">
    <h2 class="text-3xl font-extrabold text-white mb-6 border-b border-gray-700 pb-2">Add a New Album Review</h2>

    <form wire:submit.prevent="save" class="space-y-6">

        <div class="relative">
            <label class="block text-sm font-medium text-gray-300 mb-1">Album</label>
            
            @if($album_id)
                <div class="flex items-center justify-between p-3 bg-gray-700 border border-green-500/50 rounded-md shadow-sm">
                    <div class="flex items-center">
                        <span class="text-green-400 mr-2">✓</span>
                        <span class="text-white font-bold">{{ $selectedAlbumTitle }}</span>
                    </div>
                    <button type="button" wire:click="$set('album_id', '')" class="text-xs text-gray-400 hover:text-white underline decoration-gray-500 hover:decoration-white transition">
                        Change
                    </button>
                </div>
            @else
                <div class="relative">
                    <input type="text" 
                           wire:model.live.debounce.300ms="albumSearch"
                           placeholder="Type to search for an album..."
                           class="w-full p-3 bg-gray-700 border border-gray-600 text-white rounded-md focus:ring-2 focus:ring-green-500 focus:border-transparent placeholder-gray-400 transition"
                           wire:focus="$set('showDropdown', true)"
                           wire:blur="$set('showDropdown', false)"
                    >

                    @if(!empty($albumSearch) && count($searchResults) > 0)
                        <div class="absolute z-50 w-full mt-1 bg-gray-800 border border-gray-600 rounded-md shadow-xl max-h-60 overflow-y-auto">
                            <ul>
                                @foreach($searchResults as $result)
                                    <li class="cursor-pointer hover:bg-gray-700 p-3 border-b border-gray-700 last:border-0 transition flex items-center group"
                                        wire:mousedown.prevent="selectAlbum({{ $result->id }})">
                                        
                                        @if($result->cover_url)
                                            <img src="{{ $result->cover_url }}" class="w-10 h-10 rounded mr-3 object-cover shadow-sm">
                                        @else
                                            <div class="w-10 h-10 bg-gray-600 rounded mr-3 flex items-center justify-center text-gray-400">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3"></path></svg>
                                            </div>
                                        @endif
                                        
                                        <div>
                                            <div class="text-white font-bold text-sm group-hover:text-green-400 transition">{{ $result->title }}</div>
                                            <div class="text-xs text-gray-400">{{ $result->artist->artistName ?? 'Unknown' }}</div>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @elseif(!empty($albumSearch))
                        <div class="absolute z-50 w-full mt-1 bg-gray-700 border border-gray-600 rounded-md shadow-lg p-3 text-gray-400 text-sm">
                            No albums found matching "{{ $albumSearch }}".
                        </div>
                    @endif
                </div>
            @endif
            
            @error('album_id') <span class="text-red-400 text-sm block mt-1">Please select an album from the list.</span> @enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-300 mb-2">Your Rating</label>
            <div class="flex items-center space-x-1">
                @foreach(range(1, 10) as $rating)
                    <button type="button" 
                            wire:click="setRating({{ $rating }})"
                            class="focus:outline-none transition-transform duration-150 hover:scale-110 group">
                        <svg class="w-8 h-8 {{ $score >= $rating ? 'text-green-500 fill-current' : 'text-gray-600 group-hover:text-green-400' }}" 
                             xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                             <path stroke-linecap="round" stroke-linejoin="round" 
                                   d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                        </svg>
                    </button>
                @endforeach
                <span class="ml-4 text-2xl font-bold text-green-500">{{ $score > 0 ? $score : '-' }}</span>
                <span class="text-gray-500 text-sm mt-2">/10</span>
            </div>
            @error('score') <p class="mt-1 text-sm text-red-400">Please select a rating.</p> @enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-300">Review Title</label>
            <input type="text" wire:model="title" 
                   class="mt-1 block w-full bg-gray-700 border border-gray-600 text-white rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 placeholder-gray-400"
                   placeholder="Best album ever?">
            @error('title') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-300">Review Content</label>
            <textarea wire:model="comment" rows="5" 
                      class="mt-1 block w-full bg-gray-700 border border-gray-600 text-white rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 placeholder-gray-400"
                      placeholder="Share your thoughts..."></textarea>
            @error('comment') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="flex justify-end items-center pt-4">
            <button type="submit" class="px-8 py-3 bg-green-500 text-black font-bold rounded-full hover:bg-green-400 transition transform hover:scale-105 shadow-lg flex items-center">
                <svg wire:loading wire:target="save" class="animate-spin -ml-1 mr-3 h-5 w-5 text-black" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                Post Review
            </button>
        </div>
    </form>
</div>