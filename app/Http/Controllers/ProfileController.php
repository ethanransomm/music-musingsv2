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
     * edit the user's profile.
     * @param Request $request The HTTP request to the server.
     * @return View The profile edit view.
     */

    public function edit(Request $request): View
    {
        return view('profile.edit', [
            // Send user to the profile edit view.
            'user' => $request->user(),
        ]);
    }

    /**
     * Display the user's profile.
     * @param User $user The user who the profile belongs to.
     * @return View The profile view.
     */


    public function show(User $user): View
    {
        // Load the user's relevant data to display.
        $user->load(['rates.album', 'comments.rate.album', 'profile', 'favouriteAlbums.artist']);

        return view('profile.show', [
            'user' => $user,
        ]);
    }

    /**
     * Update the user's profile information.
     * @param ProfileUpdateRequest $request The validated form request.
     * @return RedirectResponse Sends user to the profile edit page with updated values.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();

        $user->fill($request->validated());

        $validated = $request->validated();

        // Update basic details.
        $user->name = $validated['name'];
        $user->email = $validated['email'];

        // If email has been changed, reset email verification.
        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        // Update profile bio.
        $user->profile->update([
            'bio' => $validated['bio'] ?? null,
        ]);

        $user->save();

        // Redirect back to profile edit view with success message.
        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Update the user's profile picture.
     * @param Request $request The HTTP request to the server.
     * @return RedirectResponse Redirects back to profile edit view with success message.
     */

    public function updatePicture(Request $request): RedirectResponse
    {
        // Validate the profile picture upload with the types valid to upload and the size limit.
        $request->validate([
            'profile_picture' => ['required', 'image', 'mimes:jpeg,png,jpg', 'max:1024'],
        ]);

        $user = $request->user();

        // Delete old profile picture if it's already set.
        if ($user->profile->profile_picture) {
            Storage::disk('public')->delete($user->profile->profile_picture);
        }

        // Store the new profile picture.
        $path = $request->file('profile_picture')->store('profile-pictures', 'public');

        // Update and save user's profile with new picture path.
        $user->profile->profile_picture = $path;
        $user->profile->save();

        // Redirect back to profile edit view with new profile picture and success message.
        return Redirect::route('profile.edit')->with('picture-updated', true);
    }
    /**
     * Delete the user's profile picture.
     * @param Request $request The HTTP request to the server.
     * @return RedirectResponse Redirects back to profile edit view with success message.
     */

    public function deletePicture(Request $request): RedirectResponse
    {
        $user = $request->user();

        // Find and delete profile picture if it's already set.
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
        // Validate the user's password before deletion.
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        // Delete profile picture when the profile is deleted.
        if ($user->profile->profile_picture) {
            Storage::disk('public')->delete($user->profile->profile_picture);
        }

        Auth::logout();

        $user->delete();
        // Invalidate the user's session and regenerate the token.
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}