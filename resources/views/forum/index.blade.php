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
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                    </path>
                </svg>
                Review an Album
            </a>
        </div>

        @if(session('success'))
            <div class="mb-6 bg-green-900/50 border border-green-500 text-green-400 px-4 py-3 rounded-lg">
                {{ session('success') }}
            </div>
        @endif

        @if ($rates->isEmpty())
            <div class="text-center p-12 bg-gray-800 rounded-xl border border-gray-700 shadow-sm">
                <div class="inline-block p-4 rounded-full bg-gray-700 mb-4">
                    <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z">
                        </path>
                    </svg>
                </div>
                <p class="text-xl text-gray-400">No reviews have been submitted yet. Be the first!</p>
            </div>
        @else
            <div class="space-y-6">
                @foreach ($rates as $rate)
                    <div id="review-{{ $rate->id }}"
                        class="bg-gray-800 p-6 rounded-xl shadow-lg border border-gray-700 hover:border-gray-600 transition duration-200">
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
                                <a href="{{ route('profile.show', $rate->user->id) }}">
                                    @if($rate->user->profile_picture)
                                        <img src="{{ asset('storage/' . $rate->user->profile_picture) }}" 
                                             alt="{{ $rate->user->name }}"
                                             class="w-6 h-6 rounded-full object-cover">
                                    @else
                                        <div class="w-6 h-6 rounded-full bg-gradient-to-br from-green-400 to-blue-500 flex items-center justify-center text-xs text-black font-bold">
                                            {{ substr($rate->user->name ?? 'U', 0, 1) }}
                                        </div>
                                    @endif
                                </a>
                                <span>
                                    <a href="{{ route('profile.show', $rate->user->id) }}"
                                        class="font-medium text-gray-300 hover:text-green-400 transition">
                                        {{ $rate->user->name ?? 'Deleted User' }}
                                    </a>
                                </span>
                            </div>
                            <span class="text-xs">
                                {{ $rate->created_at->diffForHumans() }}
                            </span>
                        </div>

                        {{-- Edit and Delete buttons --}}
                        @auth
                            @if(auth()->user()->user_admin == true || auth()->id() == $rate->user_id)
                                <div class="mt-3 pt-3 border-t border-gray-700 flex items-center space-x-4">
                                    <a href="{{ route('forum.edit', $rate->id) }}"
                                       class="text-gray-400 hover:text-green-400 text-xs font-bold uppercase tracking-wider transition duration-150">
                                        Edit
                                    </a>
                                    <form action="{{ url('/forum/' . $rate->id) }}" method="POST"
                                        onsubmit="return confirm('Are you sure you want to delete this review?');"
                                        class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="text-red-500 hover:text-red-400 text-xs font-bold uppercase tracking-wider transition duration-150">
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            @endif
                        @endauth
                    </div>

                    {{-- Comment Form --}}
                    <form class="comment-form" data-id="{{ $rate->id }}">
                        @csrf
                        <textarea name="body"
                            class="w-full bg-gray-700 text-white p-2 rounded border border-gray-600 focus:outline-none focus:border-green-500"
                            placeholder="Write a comment..." rows="2"></textarea>

                        <button type="submit"
                            class="mt-2 text-xs bg-green-500 hover:bg-green-400 text-black font-bold py-1 px-3 rounded transition">
                            Post
                        </button>
                    </form>

                    {{-- Comments List --}}
                    <div id="comments-list-{{ $rate->id }}" class="mt-4 space-y-3">
                        @foreach($rate->comments ?? [] as $comment)
                            <div class="bg-gray-800/50 p-3 rounded-lg border border-gray-700/50 text-sm">
                                <div class="flex items-start space-x-3">
                                    {{-- Profile Picture --}}
                                    <a href="{{ route('profile.show', $comment->user->id) }}" class="flex-shrink-0">
                                        @if($comment->user->profile_picture)
                                            <img src="{{ asset('storage/' . $comment->user->profile_picture) }}" 
                                                 alt="{{ $comment->user->name }}"
                                                 class="w-8 h-8 rounded-full object-cover border-2 border-gray-700 hover:border-green-500 transition">
                                        @else
                                            <div class="w-8 h-8 rounded-full bg-gradient-to-br from-green-400 to-blue-500 flex items-center justify-center text-xs text-black font-bold border-2 border-gray-700 hover:border-green-500 transition">
                                                {{ substr($comment->user->name ?? 'U', 0, 1) }}
                                            </div>
                                        @endif
                                    </a>

                                    {{-- Comment Content --}}
                                    <div class="flex-1 min-w-0">
                                        <div class="flex items-center justify-between mb-1">
                                            <a href="{{ route('profile.show', $comment->user->id) }}"
                                               class="font-bold text-green-400 text-xs hover:text-green-300 transition">
                                                {{ $comment->user->name }}
                                            </a>
                                            <span class="text-gray-500 text-[10px]">{{ $comment->created_at->diffForHumans() }}</span>
                                        </div>

                                        <p class="text-gray-300 mb-2">{{ $comment->content }}</p>

                                        {{-- Edit and Delete buttons for comments --}}
                                        @auth
                                            @if(auth()->user()->user_admin == true || auth()->id() == $comment->user_id)
                                                <div class="flex items-center space-x-3">
                                                    <button type="button"
                                                            onclick="toggleEditComment({{ $comment->id }})"
                                                            class="text-gray-400 hover:text-green-400 text-[10px] font-bold uppercase transition">
                                                        Edit
                                                    </button>
                                                    <form action="{{ url('/forum/comments/' . $comment->id) }}" method="POST"
                                                        onsubmit="return confirm('Delete this comment?');"
                                                        class="inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            class="text-red-500 hover:text-red-400 text-[10px] font-bold uppercase transition">
                                                            Delete
                                                        </button>
                                                    </form>
                                                </div>
                                            @endif
                                        @endauth

                                        {{-- Edit Form (hidden by default) --}}
                                        <div id="edit-comment-{{ $comment->id }}" class="hidden mt-2">
                                            <form class="edit-comment-form" data-comment-id="{{ $comment->id }}">
                                                @csrf
                                                @method('PATCH')
                                                <textarea name="content"
                                                    class="w-full bg-gray-700 text-white p-2 rounded border border-gray-600 focus:outline-none focus:border-green-500 text-sm"
                                                    rows="2">{{ $comment->content }}</textarea>
                                                <div class="flex items-center space-x-2 mt-2">
                                                    <button type="submit"
                                                        class="text-xs bg-green-500 hover:bg-green-400 text-black font-bold py-1 px-3 rounded transition">
                                                        Save
                                                    </button>
                                                    <button type="button"
                                                            onclick="toggleEditComment({{ $comment->id }})"
                                                            class="text-xs bg-gray-600 hover:bg-gray-500 text-white font-bold py-1 px-3 rounded transition">
                                                        Cancel
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endforeach
            </div>
        @endif
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            console.log('Comments script loaded.');

            // Post new comments
            document.querySelectorAll('.comment-form').forEach(form => {
                form.addEventListener('submit', async function (e) {
                    e.preventDefault();

                    const id = this.dataset.id;
                    const formData = new FormData(this);

                    try {
                        const response = await fetch(`/forum/${id}/comments`, {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': formData.get('_token'),
                                'Accept': 'application/json',
                                'Content-Type': 'application/json'
                            },
                            body: JSON.stringify(Object.fromEntries(formData))
                        });

                        const data = await response.json();

                        if (data.success) {
                            const list = document.getElementById(`comments-list-${id}`);
                            const newComment = `
                                <div class="bg-gray-700/50 p-2 rounded text-sm border-l-2 border-green-500">
                                    <span class="font-bold text-green-400">${data.user}:</span> 
                                    <span class="text-gray-300">${data.body}</span>
                                </div>`;

                            list.insertAdjacentHTML('afterbegin', newComment);
                            this.reset();
                        }
                    } catch (error) {
                        console.error('Error:', error);
                    }
                });
            });

            // Edit comments
            document.querySelectorAll('.edit-comment-form').forEach(form => {
                form.addEventListener('submit', async function (e) {
                    e.preventDefault();

                    const commentId = this.dataset.commentId;
                    const formData = new FormData(this);
                    const content = formData.get('content');

                    try {
                        const response = await fetch(`/comments/${commentId}`, {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': formData.get('_token'),
                                'Accept': 'application/json',
                                'Content-Type': 'application/json'
                            },
                            body: JSON.stringify({
                                _method: 'PATCH',
                                content: content
                            })
                        });

                        if (response.ok) {
                            location.reload(); // Reload to show updated comment
                        } else {
                            alert('Error updating comment');
                        }
                    } catch (error) {
                        console.error('Error:', error);
                        alert('Error updating comment');
                    }
                });
            });
        });

        // Toggle edit form visibility
        function toggleEditComment(commentId) {
            const editForm = document.getElementById(`edit-comment-${commentId}`);
            editForm.classList.toggle('hidden');
        }
    </script>
@endsection