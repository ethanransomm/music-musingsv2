<div class="max-w-2xl mx-auto p-8 bg-gray-800 shadow-xl rounded-lg mt-8 border border-gray-700">
    <h2 class="text-3xl font-extrabold text-white mb-6 border-b border-gray-700 pb-2">Add a New Album Review</h2>

    <form wire:submit.prevent="save" class="space-y-6">

        <div>
            <label class="block text-sm font-medium text-gray-300">Album</label>
            
            @if($album_id)
                <div class="mt-1 block w-full py-2 px-3 border border-gray-600 bg-gray-700 text-gray-300 rounded-md shadow-sm">
                    {{ $albums->find($album_id)->title ?? 'Selected Album' }}
                </div>
                <input type="hidden" wire:model="album_id">
            @else
                <select wire:model="album_id" class="mt-1 block w-full py-2 px-3 border border-gray-600 bg-gray-700 text-gray-200 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500">
                    <option value="">-- Select an Album --</option>
                    @foreach ($albums as $album)
                        <option value="{{ $album->id }}">{{ $album->title }}</option>
                    @endforeach
                </select>
            @endif
            
            @error('album_id') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-300 mb-2">Your Rating</label>
            <div class="flex items-center space-x-1">
                @foreach(range(1, 10) as $rating)
                    <button type="button" 
                            wire:click="setRating({{ $rating }})"
                            class="focus:outline-none transition-colors duration-150 group">
                        <svg class="w-8 h-8 {{ $score >= $rating ? 'text-green-500 fill-current' : 'text-gray-600 group-hover:text-green-400' }}" 
                             xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                             <path stroke-linecap="round" stroke-linejoin="round" 
                                   d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                        </svg>
                    </button>
                @endforeach
                <span class="ml-4 text-lg font-bold text-green-500">{{ $score > 0 ? $score . '/10' : '' }}</span>
            </div>
            @error('score') <p class="mt-1 text-sm text-red-400">Please select a rating.</p> @enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-300">Review Title</label>
            <input type="text" wire:model="title" class="mt-1 block w-full border-gray-600 bg-gray-700 text-white rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 placeholder-gray-400">
            @error('title') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
        </div>


        <div>
            <label class="block text-sm font-medium text-gray-300">Review Content</label>
            <textarea wire:model="comment" rows="5" class="mt-1 block w-full border-gray-600 bg-gray-700 text-white rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 placeholder-gray-400"></textarea>
            @error('comment') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="flex justify-end items-center pt-4">
            <button type="submit" class="px-6 py-2 bg-green-500 text-black font-bold rounded-full hover:bg-green-400 transition duration-150 flex items-center shadow-lg transform hover:scale-105">
                <svg wire:loading wire:target="save" class="animate-spin -ml-1 mr-3 h-5 w-5 text-black" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                Post Review
            </button>
        </div>
    </form>
</div>