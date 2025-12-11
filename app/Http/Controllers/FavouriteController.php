<?php

namespace App\Http\Controllers;

use App\Models\Album;
use Illuminate\Http\RedirectResponse;

class FavouriteController extends Controller
{
    /**
     * Toggle a user's favourite of an album.
     * @param Album $album the album which is being favourited or unfavourited.
     * @return RedirectResponse the response after toggling the favourite status sending the user back to the album show page.
     */

    public function toggle(Album $album): RedirectResponse
    {
        // Get the authenticated user
        $user = auth()->user();

        // Check if the album is already favourited by the user and remove or add it if it's favourited
        if ($user->favouriteAlbums()->where('album_id', $album->id)->exists()) {
            $user->favouriteAlbums()->detach($album->id);
            return back()->with('success', 'Removed from favorites');
        } else {
            $user->favouriteAlbums()->attach($album->id);
            return back()->with('success', 'Added to favorites');
        }
    }

    /**
     * Authorises user to view their favourite albums.
     * @return \Illuminate\Contracts\View\View the view of the user's favourite albums.
     */

    public function index()
    {
        // Retrieve the user's favourite albums with artist relationship and order by latest.
        $favouriteAlbums = auth()->user()->favouriteAlbums()
            ->with('artist')
            ->latest('user_album_favorites.created_at')
            ->get();

        // Return the favourites index with the favourite albums data.    
        return view('favourites.index', compact('favouriteAlbums'));
    }
}