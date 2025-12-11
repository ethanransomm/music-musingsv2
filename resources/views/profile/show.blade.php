@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    
    <div class="bg-gray-800 rounded-xl shadow-lg border border-gray-700 overflow-hidden mb-8">
        <div class="p-8 sm:flex sm:items-center">
            <div class="sm:flex-shrink-0">
                @if($user->profile->profile_picture)
                    <img src="{{ asset('storage/' . $user->profile->profile_picture) }}" 
                         alt="{{ $user->name }}"
                         class="w-32 h-32 rounded-full object-cover shadow-lg mx-auto sm:mx-0 border-4 border-gray-700">
                @else
                    <div class="w-32 h-32 rounded-full bg-gradient-to-br from-green-400 to-blue-500 flex items-center justify-center text-4xl font-bold text-black shadow-lg mx-auto sm:mx-0">
                        {{ substr($user->name, 0, 1) }}
                    </div>
                @endif
            </div>
            <div class="mt-4 sm:mt-0 sm:ml-6 text-center sm:text-left">
                <h1 class="text-3xl font-extrabold text-white">{{ $user->name }}</h1>
                <p class="text-gray-400 text-sm mt-1">Joined {{ $user->created_at->format('F Y') }}</p>
                
                @if($user->profile->bio)
                    <p class="mt-4 text-gray-300 max-w-2xl">{{ $user->profile->bio }}</p>
                @else
                    <p class="mt-4 text-gray-500 italic">No bio yet.</p>
                @endif
                
                @if(auth()->id() === $user->id)
                    <div class="mt-6">
                        <a href="{{ route('profile.edit') }}" class="inline-flex items-center px-4 py-2 bg-gray-700 border border-gray-600 rounded-full font-semibold text-xs text-white uppercase tracking-widest shadow-sm hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 focus:ring-offset-gray-800 transition ease-in-out duration-150">
                            Edit Profile
                        </a>
                    </div>
                @endif
            </div>
        </div>
        
        <div class="bg-gray-900/50 px-8 py-4 border-t border-gray-700 flex justify-around sm:justify-start sm:space-x-12">
            <div class="text-center sm:text-left">
                <span class="block text-2xl font-bold text-white">{{ $user->rates->count() }}</span>
                <span class="text-xs text-gray-500 uppercase tracking-wide">Reviews</span>
            </div>
            <div class="text-center sm:text-left">
                <span class="block text-2xl font-bold text-white">{{ $user->comments->count() }}</span>
                <span class="text-xs text-gray-500 uppercase tracking-wide">Comments</span>
            </div>
        </div>
    </div>

    <div class="mb-6 border-b border-gray-800" x-data="{ tab: 'reviews' }">
        <div class="flex space-x-8">
            <button @click="tab = 'reviews'" 
                    :class="tab === 'reviews' ? 'border-green-500 text-white' : 'border-transparent text-gray-400 hover:text-gray-300'"
                    class="pb-4 px-1 border-b-2 font-bold text-sm uppercase tracking-wide transition">
                Reviews
            </button>
            <button @click="tab = 'comments'" 
                    :class="tab === 'comments' ? 'border-green-500 text-white' : 'border-transparent text-gray-400 hover:text-gray-300'"
                    class="pb-4 px-1 border-b-2 font-bold text-sm uppercase tracking-wide transition">
                Comments
            </button>
        </div>

        <div x-show="tab === 'reviews'" class="mt-6">
            <h2 class="text-2xl font-bold text-white mb-6">Recent Reviews</h2>

            @if($user->rates->isEmpty())
                <div class="text-gray-500 italic text-center py-12">This user hasn't posted any reviews yet.</div>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    @foreach($user->rates as $review)
                        <div class="bg-gray-800 p-6 rounded-xl border border-gray-700 shadow-sm hover:border-gray-600 transition">
                            <div class="flex items-start space-x-4">
                                <a href="{{ route('album.show', $review->album->id) }}" class="flex-shrink-0 block w-16 h-16 bg-gray-900 rounded-md overflow-hidden">
                                    @if($review->album->cover_url)
                                        <img src="{{ $review->album->cover_url }}" alt="{{ $review->album->title }}" class="w-full h-full object-cover">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center text-gray-600">
                                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3"></path></svg>
                                        </div>
                                    @endif
                                </a>
                                
                                <div class="flex-1 min-w-0">
                                    <h3 class="text-lg font-bold text-white truncate">
                                        <a href="{{ route('album.show', $review->album->id) }}" class="hover:text-green-500 transition">
                                            {{ $review->album->title }}
                                        </a>
                                    </h3>
                                    <div class="flex items-center space-x-2 mt-1">
                                        <div class="flex text-green-500 text-sm">
                                            @for($i=0; $i<$review->score; $i++) ★ @endfor
                                        </div>
                                        <span class="text-xs text-gray-500">{{ $review->created_at->diffForHumans() }}</span>
                                    </div>
                                    <p class="text-gray-300 text-sm mt-2 line-clamp-3">"{{ $review->comment }}"</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

<section class="mb-9 mt-6">
    <h2 class="text-2xl font-bold text-white mb-6">Favourite Albums</h2>
    
    @if($user->favouriteAlbums && $user->favouriteAlbums->count() > 0)
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach($user->favouriteAlbums as $album)
                <a href="{{ route('album.show', $album->id) }}" class="group">
                    <div class="bg-gray-800 rounded-lg overflow-hidden border border-gray-700 hover:border-purple-500 transition">
                       
                        <div class="aspect-square bg-gray-900 relative">
                            @if($album->cover_url)
                                <img src="{{ $album->cover_url }}" 
                                     alt="{{ $album->title }}" 
                                     class="w-full h-full object-cover group-hover:opacity-75 transition">
                            @else
                                <div class="flex items-center justify-center h-full text-gray-600">
                                    <svg class="w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                              d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3">
                                        </path>
                                    </svg>
                                </div>
                            @endif
                        </div>
                        
                        <div class="p-4">
                            <h3 class="font-semibold text-white group-hover:text-purple-400 transition truncate">
                                {{ $album->title }}
                            </h3>
                            <p class="text-sm text-gray-400 truncate">
                                {{ $album->artist->artist_name ?? 'Unknown Artist' }}
                            </p>
                            <p class="text-xs text-gray-500 mt-1">
                                {{ $album->release_date ? \Carbon\Carbon::parse($album->release_date)->format('Y') : 'Unknown' }}
                            </p>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    @else
        <div class="bg-gray-800 rounded-lg border border-gray-700 p-12 text-center">
            <svg class="w-16 h-16 mx-auto text-gray-600 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                      d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z">
                </path>
            </svg>
            <p class="text-gray-400 text-lg">
                @if(auth()->check() && auth()->user()->id === $user->id)
                    No favourited albums yet.
                @else
                    {{ $user->name }} hasn't favourited any albums yet.
                @endif
            </p>
        </div>
    @endif
</section>


        <div x-show="tab === 'comments'" class="mt-6">
            <h2 class="text-2xl font-bold text-white mb-6">Recent Comments</h2>

            @if($user->comments->isEmpty())
                <div class="text-gray-500 italic text-center py-12">This user hasn't posted any comments yet.</div>
            @else
                <div class="space-y-4">
                    @foreach($user->comments as $comment)
                        <div class="bg-gray-800 p-6 rounded-xl border border-gray-700 shadow-sm hover:border-gray-600 transition">
                            <div class="flex items-start space-x-4">
                                <div class="flex-1">
                                    <div class="flex items-center justify-between">
                                        <span class="text-xs text-gray-500">
                                            Commented on 
                                            @if($comment->rate)
                                                <a href="{{ route('album.show', $comment->rate->album_id) }}" class="text-green-400 hover:text-green-300 font-semibold">
                                                    {{ $comment->rate->album->title ?? 'Album' }}
                                                </a>
                                            @else
                                                <span class="text-gray-400">a review</span>
                                            @endif
                                        </span>
                                        <span class="text-xs text-gray-500">{{ $comment->created_at->diffForHumans() }}</span>
                                    </div>
                                    <p class="text-gray-300 mt-3">{{ $comment->content }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
@endsection