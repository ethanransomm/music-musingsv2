<?php

namespace App\Http\Controllers;

use App\Models\Rate;
use App\Models\User;
use App\Models\Album;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Js;

class RateController extends Controller
{

    /**
     * Displays a listing of all rates by users.
     * @return \Illuminate\View\View the forum index view with rates.
     */

    public function index()
    {
        // Retrieve all albums users have rated, ordered by latest with 20 rates per page.
        $rates = Rate::with('user', 'album')->latest()->paginate(20);
        // Return the forum index view with the rates listing.
        return view('forum.index', ['rates' => $rates]);
    }

    /**
     * Show the form for creating a new rate.
     * @return \Illuminate\View\View the rate creation view.
     */
   
    public function create()
    {
        // Retrieve all albums with their associated artists for the rate creation form.
        $albums = Album::with('artist')->orderBy('title')->get();
        return view('forum.create', compact('albums'));
    }

    /**
     * Store the newly created rate.
     * @param Request $request the HTTP request containing rate data.
     * @return \Illuminate\Http\RedirectResponse sends user back to forum index page.
     */
    public function store(Request $request)
    {
        // Validate the incoming request data.
        $validated = $request->validate([
            'album_id' => 'required|exists:albums,id',
            'score' => 'required|integer|min:1|max:10',
            'title' => 'required|string|max:255',
            'comment' => 'required|string|max:2000',
        ]);

        // Check if the user has already rated this album, as a user cannot rate the same album multiple times.
        $existingRate = Rate::where('user_id', auth()->id())
                            ->where('album_id', $validated['album_id'])
                            ->first();
        // Redirect back with error if a rate already exists for this user and the album selected.                         
        if ($existingRate) {
            return redirect()->back()
                ->withInput()
                ->withErrors(['album_id' => 'You have already reviewed this album.']);
        }

        // Create the new rate record in the database if the album hasn't already been reviewed by the user.
        Rate::create([
            'user_id' => auth()->id(),
            'album_id' => $validated['album_id'],
            'score' => $validated['score'],
            'title' => $validated['title'],
            'comment' => $validated['comment'],
        ]);

        // Redirect back to forum index page once the rating is created.
        return redirect()->route('forum.index')
            ->with('success', 'Review posted successfully!');
    }

    /**
     * Display the rate along with it's comments.
     * @param mixed $id the rate id.
     * @return \Illuminate\View\View the view showing the rate details.
     */

    public function show($id)
    {
        // Retrieve the rate with the user, album and comments relationships.
        $rate = Rate::with(['user', 'album.artist', 'comments.user'])->findOrFail($id);
        // Redirect to the forum show view with the rate listings.
        return view('forum.show', compact('rate'));
    }

    /**
     * Enables editing of a rate by an authenticated user.
     * @param mixed $id The rate id.
     * @return \Illuminate\Contracts\View\View returns the forum edit view if the user is valid.
     */
    public function edit($id)
    {
        // Retrieve the rate with the album and artist relationship.
        $rate = Rate::with('album.artist')->findOrFail($id);
        // If the authenticated user did not create the rate and is not an admin, abort with 403 error code.
        if (auth()->id() !== $rate->user_id && !auth()->user()->user_admin) {
            abort(403, 'Unauthorized action.');
        }
        // If the user created the rating or is an admin, return the forum edit view with the rate data.
        return view('forum.edit', compact('rate'));
    }


    /**
     * Update the rate with changed data from the user.
     * @param Request $request the HTTP request containing updated rate data.
     * @param mixed $id the rate id.
     * @return \Illuminate\Http\RedirectResponse redirects back to forum index page with success message.
     */

    public function update(Request $request, $id)
    {
        // Retrieve the rate to be updated.
        $rate = Rate::findOrFail($id);

        // Ensure the authenticated user is either the creator of the rate or an admin.
        if (auth()->id() !== $rate->user_id && !auth()->user()->user_admin) {
            abort(403, 'Unauthorized action.');
        }

        // Validate the updated rate data.
        $validated = $request->validate([
            'score' => 'required|integer|min:1|max:10',
            'title' => 'required|string|max:255',
            'comment' => 'required|string|max:2000',
        ]);

        // Update the rate with the validated data.
        $rate->update($validated);

        // Redirect back to forum index page with success message.
        return redirect()->route('forum.index')
            ->with('success', 'Review updated successfully!');
    }


    /**
     * Delete a rate from the database.
     * @param mixed $id the rate id.
     * @return \Illuminate\Http\JsonResponse in case of an AJAX request.
     * @return \Illuminate\Http\RedirectResponse redirects back to forum index with success message if user is authenticated.
     */

    public function delete($id): RedirectResponse|JsonResponse
    {
        // Retrieve the rate to be deleted.
        $rate = Rate::findOrFail($id);
        $user = auth()->user();

        // If the user doesn't have an ID, they cannot delete the rate as they don't have an account.
        if (!$user) {
           return response()->json(['error' => 'Unauthenticated.'], 401);
        }

        // If the user's not an admin and didn't create the rate, forbid deletion.
        if ($user->user_admin !== true && $user->id !== $rate->user_id) {
            return response()->json(['error' => 'Forbidden.'], 403);
        }

        $rate->delete();

        // Redirect back to forum index with success message.
        return redirect()->route('forum.index')
            ->with('success', 'Review deleted successfully!');
    }
}