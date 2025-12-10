@extends('layouts.app')

@section('content')
    @auth
        <livewire:create-review />
    @else
        <div class="max-w-2xl mx-auto p-8 bg-gray-800/50 backdrop-blur-sm shadow-xl rounded-lg mt-8 border border-gray-700 text-center">
            <div class="mb-6">
                <svg class="w-20 h-20 mx-auto text-gray-600 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                </svg>
                <h2 class="text-3xl font-bold text-white mb-3">Login Required</h2>
                <p class="text-gray-300 text-lg mb-6">You must be logged in to leave a review.</p>
            </div>
            <div class="flex justify-center gap-4">
                <a href="{{ route('login') }}" 
                   class="px-8 py-3 bg-green-500 hover:bg-green-600 text-black font-bold rounded-full transition transform hover:scale-105 shadow-lg">
                    Log In to Review
                </a>
                <a href="{{ route('register') }}" 
                   class="px-8 py-3 bg-gray-700 hover:bg-gray-600 text-white font-bold rounded-full transition transform hover:scale-105 shadow-lg">
                    Sign Up
                </a>
            </div>
        </div>
    @endauth
@endsection