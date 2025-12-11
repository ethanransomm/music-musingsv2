<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use App\Models\Rate;
use App\Notifications\CommentNotification;

class CommentController extends Controller
{
    public function store(Request $request, $id)
    {
        $validated = $request->validate([
            'body' => 'required|string|max:1000',
        ]);

        Comment::create([
            'user_id' => auth()->id(),
            'rate_id' => $id,
            'content' => $validated['body'],
        ]);

        $rate = Rate::with('album')->findOrFail($id);

        if ($rate->user_id !== auth()->id()) {
            $rate->user->notify(new CommentNotification(
                auth()->user()->name,
                $rate->album->title
            ));
        }

        return response()->json([
            'success' => true,
            'user' => auth()->user()->name,
            'body' => $validated['body'],
        ]);
    }

    public function update(Request $request, $id)
    {
        $comment = Comment::findOrFail($id);

        
        if (auth()->id() !== $comment->user_id && !auth()->user()->user_admin) {
            abort(403, 'Unauthorized action.');
        }

        $validated = $request->validate([
            'content' => 'required|string|max:1000',
        ]);

        $comment->update($validated);

        return back()->with('success', 'Comment updated successfully!');
    }

    public function delete($id)
    {
        $comment = Comment::findOrFail($id);

        if (auth()->id() !== $comment->user_id && !auth()->user()->user_admin) {
            abort(403, 'Unauthorized action.');
        }

        $comment->delete();

        return back()->with('success', 'Comment deleted successfully!');
    }
}