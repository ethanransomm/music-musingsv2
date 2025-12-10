<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

   
    public function show(User $user): View
    {
        $user->load(['rates.album', 'comments.rate.album']);
        
        return view('profile.show', [
            'user' => $user,
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();
        
        $user->fill($request->validated());

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    public function updatePicture(Request $request): RedirectResponse
    {
        $request->validate([
            'profile_picture' => ['required', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
        ]);

        $user = $request->user();

        if ($user->profile->profile_picture) {
            Storage::disk('public')->delete($user->profile->profile_picture);
        }

        $path = $request->file('profile_picture')->store('profile-pictures', 'public');
        
        $user->profile->profile_picture = $path;
        $user->profile->save();

        return Redirect::route('profile.edit')->with('picture-updated', true);
    }
    public function deletePicture(Request $request): RedirectResponse
    {
        $user = $request->user();

        if ($user->profile->profile_picture) {
            Storage::disk('public')->delete($user->profile->profile_picture);
            $user->profile->profile_picture = null;
            $user->profile->save();
        }

        return Redirect::route('profile.edit')->with('picture-deleted', true);
    }

    /**
     * Delete the user's account.
     */

    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        if ($user->profile->profile_picture) {
            Storage::disk('public')->delete($user->profile->profile_picture);
        }

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}