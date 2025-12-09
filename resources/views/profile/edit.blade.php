@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    
    <h1 class="text-3xl font-bold text-white mb-8">Edit Profile</h1>

    <div class="bg-gray-800 rounded-xl shadow-lg border border-gray-700 overflow-hidden mb-6">
        <div class="p-6">
            <h2 class="text-xl font-bold text-white mb-4">Profile Picture</h2>
            <p class="text-sm text-gray-400 mb-6">Update your profile picture. Recommended size: 400x400px</p>

            <form method="POST" action="{{ route('profile.picture.update') }}" enctype="multipart/form-data" class="space-y-4">
                @csrf
                @method('PATCH')

                <div class="flex items-center space-x-6">
                    @if(auth()->user()->profile_picture)
                        <img src="{{ asset('storage/' . auth()->user()->profile_picture) }}" 
                             alt="{{ auth()->user()->name }}"
                             class="w-24 h-24 rounded-full object-cover border-4 border-gray-700">
                    @else
                        <div class="w-24 h-24 rounded-full bg-gradient-to-br from-green-400 to-blue-500 flex items-center justify-center text-3xl font-bold text-black">
                            {{ substr(auth()->user()->name, 0, 1) }}
                        </div>
                    @endif

                    <div class="flex-1">
                        <input type="file" 
                               name="profile_picture" 
                               id="profile_picture"
                               accept="image/*"
                               class="block w-full text-sm text-gray-400
                                      file:mr-4 file:py-2 file:px-4
                                      file:rounded-full file:border-0
                                      file:text-sm file:font-semibold
                                      file:bg-green-500 file:text-white
                                      hover:file:bg-green-600
                                      file:cursor-pointer cursor-pointer
                                      transition">
                        @error('profile_picture')
                            <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="flex items-center gap-4">
                    <button type="submit" 
                            class="inline-flex items-center px-4 py-2 bg-green-500 border border-transparent rounded-full font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 focus:ring-offset-gray-800 transition">
                        Upload Picture
                    </button>

                    @if(auth()->user()->profile_picture)
                        <form method="POST" action="{{ route('profile.picture.delete') }}" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                    class="text-sm text-red-400 hover:text-red-300 font-semibold uppercase">
                                Remove Picture
                            </button>
                        </form>
                    @endif
                </div>

                @if(session('picture-updated'))
                    <p class="text-sm text-green-400">Profile picture updated successfully!</p>
                @endif
            </form>
        </div>
    </div>


    <div class="bg-gray-800 rounded-xl shadow-lg border border-gray-700 overflow-hidden mb-6">
        <div class="p-6">
            <h2 class="text-xl font-bold text-white mb-4">Profile Information</h2>
            <p class="text-sm text-gray-400 mb-6">Update your account's profile information and email address.</p>

            <form method="POST" action="{{ route('profile.update') }}" class="space-y-6">
                @csrf
                @method('PATCH')

                <div>
                    <label for="name" class="block text-sm font-medium text-gray-300 mb-2">Name</label>
                    <input type="text" 
                           name="name" 
                           id="name" 
                           value="{{ old('name', $user->name) }}"
                           required
                           class="w-full px-4 py-3 bg-gray-700 border border-gray-600 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition">
                    @error('name')
                        <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="email" class="block text-sm font-medium text-gray-300 mb-2">Email</label>
                    <input type="email" 
                           name="email" 
                           id="email" 
                           value="{{ old('email', $user->email) }}"
                           required
                           class="w-full px-4 py-3 bg-gray-700 border border-gray-600 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition">
                    @error('email')
                        <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="bio" class="block text-sm font-medium text-gray-300 mb-2">Bio</label>
                    <textarea name="bio" 
                              id="bio" 
                              rows="4"
                              maxlength="500"
                              placeholder="Tell us about yourself..."
                              class="w-full px-4 py-3 bg-gray-700 border border-gray-600 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition">{{ old('bio', $user->bio) }}</textarea>
                    <p class="mt-2 text-xs text-gray-500">Maximum 500 characters</p>
                    @error('bio')
                        <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center gap-4">
                    <button type="submit" 
                            class="inline-flex items-center px-4 py-2 bg-green-500 border border-transparent rounded-full font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 focus:ring-offset-gray-800 transition">
                        Save
                    </button>

                    @if(session('status') === 'profile-updated')
                        <p class="text-sm text-green-400">Saved successfully!</p>
                    @endif
                </div>
            </form>
        </div>
    </div>

    <div class="bg-gray-800 rounded-xl shadow-lg border border-gray-700 overflow-hidden mb-6">
        <div class="p-6">
            <h2 class="text-xl font-bold text-white mb-4">Update Password</h2>
            <p class="text-sm text-gray-400 mb-6">Ensure your account is using a long, random password to stay secure.</p>

            <form method="POST" action="{{ route('password.update') }}" class="space-y-6">
                @csrf
                @method('PUT')

                <div>
                    <label for="current_password" class="block text-sm font-medium text-gray-300 mb-2">Current Password</label>
                    <input type="password" 
                           name="current_password" 
                           id="current_password"
                           autocomplete="current-password"
                           class="w-full px-4 py-3 bg-gray-700 border border-gray-600 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition">
                    @error('current_password')
                        <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-gray-300 mb-2">New Password</label>
                    <input type="password" 
                           name="password" 
                           id="password"
                           autocomplete="new-password"
                           class="w-full px-4 py-3 bg-gray-700 border border-gray-600 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition">
                    @error('password')
                        <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-300 mb-2">Confirm Password</label>
                    <input type="password" 
                           name="password_confirmation" 
                           id="password_confirmation"
                           autocomplete="new-password"
                           class="w-full px-4 py-3 bg-gray-700 border border-gray-600 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition">
                    @error('password_confirmation')
                        <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center gap-4">
                    <button type="submit" 
                            class="inline-flex items-center px-4 py-2 bg-green-500 border border-transparent rounded-full font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 focus:ring-offset-gray-800 transition">
                        Save
                    </button>

                    @if(session('status') === 'password-updated')
                        <p class="text-sm text-green-400">Password updated successfully!</p>
                    @endif
                </div>
            </form>
        </div>
    </div>

    <div class="bg-gray-800 rounded-xl shadow-lg border border-red-900/50 overflow-hidden">
        <div class="p-6">
            <h2 class="text-xl font-bold text-red-400 mb-4">Delete Account</h2>
            <p class="text-sm text-gray-400 mb-6">
                Once your account is deleted, all of its resources and data will be permanently deleted. 
                Before deleting your account, please download any data or information that you wish to retain.
            </p>

            <button type="button"
                    onclick="document.getElementById('deleteModal').classList.remove('hidden')"
                    class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-full font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 focus:ring-offset-gray-800 transition">
                Delete Account
            </button>
        </div>
    </div>

    <div id="deleteModal" class="hidden fixed inset-0 bg-black/75items-center justify-center z-50">
        <div class="bg-gray-800 rounded-xl max-w-md w-full mx-4 p-6 border border-gray-700">
            <h3 class="text-xl font-bold text-white mb-4">Are you sure?</h3>
            <p class="text-gray-400 mb-6">
                Once your account is deleted, all of its resources and data will be permanently deleted. 
                Please enter your password to confirm you would like to permanently delete your account.
            </p>

            <form method="POST" action="{{ route('profile.destroy') }}">
                @csrf
                @method('DELETE')

                <div class="mb-6">
                    <label for="password_delete" class="block text-sm font-medium text-gray-300 mb-2">Password</label>
                    <input type="password" 
                           name="password" 
                           id="password_delete"
                           class="w-full px-4 py-3 bg-gray-700 border border-gray-600 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent transition">
                    @error('password', 'userDeletion')
                        <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center gap-4">
                    <button type="submit" 
                            class="px-4 py-2 bg-red-600 border border-transparent rounded-full font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 transition">
                        Delete Account
                    </button>
                    <button type="button"
                            onclick="document.getElementById('deleteModal').classList.add('hidden')"
                            class="px-4 py-2 bg-gray-700 border border-gray-600 rounded-full font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-600 transition">
                        Cancel
                    </button>
                </div>
            </form>
        </div>
    </div>

</div>
@endsection