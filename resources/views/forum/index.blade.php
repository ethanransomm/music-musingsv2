@extends('layouts.app')

@section('content')
    <div class="max-w-4xl mx-auto">
        <h1 class="text-4xl font-extrabold text-gray-900 mb-6">Rate an Album</h1>
        <p class="text-gray-600 mb-8">Browse featured musings by our users.</p>

        @if ($rates->isEmpty())
            <div class="text-center p-12 bg-white rounded-lg shadow-inner">
                <p class="text-xl text-gray-500">No reviews have been submitted yet. Be the first!</p>
            </div>
        @else
            <div class="space-y-6">
                @foreach ($rates as $rate)
                    <div class="bg-white p-6 rounded-xl shadow-lg border border-gray-100">
                        <div class="flex justify-between items-start mb-3 border-b pb-3">
                            <h2 class="text-xl font-semibold text-gray-800">
                                <a href="{{ route('album.show', ['title' => $rate->album->title]) }}" class="hover:text-indigo-600 transition">
                                    {{ $rate->album->title }}
                                </a>
                            </h2>
                            <span class="text-3xl font-bold text-indigo-600">
                                {{ $rate->score }}<span class="text-lg font-normal text-gray-400">/10</span>
                            </span>
                        </div>

                        <p class="text-gray-700 mb-4 italic">"{{ $rate->comment }}"</p>

                        <div class="text-sm text-gray-500 flex justify-between items-center">
                            <span>
                                Rated by: 
                                <span class="font-medium text-gray-700">
                                    {{ $rate->user->name ?? 'Deleted User' }}
                                </span>
                            </span>
                            <span>
                                {{ $rate->created_at->diffForHumans() }} 
                            </span>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection



