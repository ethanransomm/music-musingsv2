<?php

namespace App\Http\Controllers;

use App\Models\Album;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class FavouriteController extends Controller
{
    public function toggle(Album $album): RedirectResponse
    {
        $user = auth()->user();

        if ($user->favouriteAlbums()->where('album_id', $album->id)->exists()) {
            $user->favouriteAlbums()->detach($album->id);
            return back()->with('success', 'Removed from favorites');
        } else {
            $user->favouriteAlbums()->attach($album->id);
            return back()->with('success', 'Added to favorites');
        }
    }

    public function index()
    {
        $favouriteAlbums = auth()->user()->favouriteAlbums()
            ->with('artist')
            ->latest('user_album_favorites.created_at')
            ->get();

        return view('favourites.index', compact('favouriteAlbums'));
    }
}