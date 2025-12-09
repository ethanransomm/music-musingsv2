<?php

namespace App\Http\Controllers;

use App\Models\Rate;
use App\Models\User;
use App\Models\Album;
use Illuminate\Http\Request;

class RateController extends Controller
{

    public function index()
    {
        $rates = Rate::with('user', 'album')->latest()->paginate(20);
        return view('forum.index', ['rates' => $rates]);
    }

   
    public function create()
    {
        $albums = Album::with('artist')->orderBy('title')->get();
        return view('forum.create', compact('albums'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'album_id' => 'required|exists:albums,id',
            'score' => 'required|integer|min:1|max:10',
            'title' => 'required|string|max:255',
            'comment' => 'required|string|max:2000',
        ]);

        $existingRate = Rate::where('user_id', auth()->id())
                            ->where('album_id', $validated['album_id'])
                            ->first();

        if ($existingRate) {
            return redirect()->back()
                ->withInput()
                ->withErrors(['album_id' => 'You have already reviewed this album. Please edit your existing review.']);
        }

        Rate::create([
            'user_id' => auth()->id(),
            'album_id' => $validated['album_id'],
            'score' => $validated['score'],
            'title' => $validated['title'],
            'comment' => $validated['comment'],
        ]);

        return redirect()->route('forum.index')
            ->with('success', 'Review posted successfully!');
    }


    public function show($id)
    {
        $rate = Rate::with(['user', 'album.artist', 'comments.user'])->findOrFail($id);
        return view('forum.show', compact('rate'));
    }

    public function edit($id)
    {
        $rate = Rate::with('album.artist')->findOrFail($id);
        
        if (auth()->id() !== $rate->user_id && !auth()->user()->user_admin) {
            abort(403, 'Unauthorized action.');
        }

        return view('forum.edit', compact('rate'));
    }


    public function update(Request $request, $id)
    {
        $rate = Rate::findOrFail($id);

        if (auth()->id() !== $rate->user_id && !auth()->user()->user_admin) {
            abort(403, 'Unauthorized action.');
        }

        $validated = $request->validate([
            'score' => 'required|integer|min:1|max:10',
            'title' => 'required|string|max:255',
            'comment' => 'required|string|max:2000',
        ]);

        $rate->update($validated);

        return redirect()->route('forum.index')
            ->with('success', 'Review updated successfully!');
    }


    public function delete($id)
    {
        $rate = Rate::findOrFail($id);
        $user = auth()->user();

        if (!$user) {
            return response()->json(['error' => 'Unauthenticated.'], 401);
        }

        if ($user->user_admin !== true && $user->id !== $rate->user_id) {
            return response()->json(['error' => 'Forbidden.'], 403);
        }

        $rate->delete();

        return redirect()->route('forum.index')
            ->with('success', 'Review deleted successfully!');
    }
}