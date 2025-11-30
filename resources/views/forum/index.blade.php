@extends('layouts.app')

@section('content')
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        
        
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-10 gap-4">
            <div>
                <h1 class="text-4xl font-extrabold text-white mb-2">Rate an Album</h1>
                <p class="text-gray-400">Browse featured musings by our users.</p>
            </div>
            
        
            <a href="{{ route('forum.create') }}" 
               class="inline-flex items-center justify-center px-6 py-3 bg-green-500 text-black font-bold rounded-full hover:bg-green-400 transition transform hover:scale-105 shadow-lg">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                Review an Album
            </a>
        </div>

        @if ($rates->isEmpty())
           
            <div class="text-center p-12 bg-gray-800 rounded-xl border border-gray-700 shadow-sm">
                <div class="inline-block p-4 rounded-full bg-gray-700 mb-4">
                    <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"></path></svg>
                </div>
                <p class="text-xl text-gray-400">No reviews have been submitted yet. Be the first!</p>
            </div>
        @else
         
            <div class="space-y-6">
                @foreach ($rates as $rate)
                    <div class="bg-gray-800 p-6 rounded-xl shadow-lg border border-gray-700 hover:border-gray-600 transition duration-200">
                        
                      
                        <div class="flex justify-between items-start mb-4 border-b border-gray-700 pb-4">
                            <div>
                                <h2 class="text-xl font-bold text-white">
                                    <a href="{{ route('album.show', $rate->album->id) }}"
                                        class="hover:text-green-400 transition duration-150 hover:underline decoration-green-500/50">
                                        {{ $rate->album->title }}
                                    </a>
                                </h2>
                                <p class="text-sm text-gray-500 mt-1">
                                    {{ $rate->album->artist->artistName ?? 'Unknown Artist' }}
                                </p>
                            </div>
                            
                            
                            <div class="flex items-center space-x-1 bg-gray-900 px-3 py-1 rounded-lg border border-gray-700">
                                <span class="text-2xl font-bold text-green-500">{{ $rate->score }}</span>
                                <span class="text-sm font-normal text-gray-500">/10</span>
                            </div>
                        </div>

                       
                        <div class="relative pl-4 border-l-4 border-gray-600 mb-4">
                            <h3 class="font-bold text-gray-200 text-lg mb-1">{{ $rate->title }}</h3>
                            <p class="text-gray-300 italic leading-relaxed">"{{ $rate->comment }}"</p>
                        </div>

                       
                        <div class="text-sm text-gray-500 flex justify-between items-center pt-2">
                            <div class="flex items-center space-x-2">
                                <div class="w-6 h-6 rounded-full bg-gradient-to-br from-green-400 to-blue-500 flex items-center justify-center text-xs text-black font-bold">
                                    {{ substr($rate->user->name ?? 'U', 0, 1) }}
                                </div>
                                <span>
                                    Rated by <span class="font-medium text-gray-300">{{ $rate->user->name ?? 'Deleted User' }}</span>
                                </span>
                            </div>
                            <span class="text-xs">
                                {{ $rate->created_at->diffForHumans() }}
                            </span>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection