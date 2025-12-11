<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use App\Models\Rate;
use App\Notifications\CommentNotification;

class CommentController extends Controller
{


    /**
     * Stores a newly created comment on a rating.
     * @param Request $request the HTTP request to the server.
     * @param mixed $id the user id and rate id.
     * @return \Illuminate\Http\JsonResponse the AJAX response confirming the comment was created.
     */

    public function store(Request $request, $id)
    {
        // Validate the comment request
        $validated = $request->validate([
            'body' => 'required|string|max:1000',
        ]);

        // Create the comment with the validated data
        Comment::create([
            'user_id' => auth()->id(),
            'rate_id' => $id,
            'content' => $validated['body'],
        ]);

        // Load the rate with album relationship for notification
        $rate = Rate::with('album')->findOrFail($id);

        // Notify the user who reviewed the album about the new comment
        if ($rate->user_id !== auth()->id()) {
            $rate->user->notify(new CommentNotification(
                auth()->user()->name,
                $rate->album->title
            ));
        }

        // Return a JSON (AJAX) response indicating the comment was created successfully
        return response()->json([
            'success' => true,
            'user' => auth()->user()->name,
            'body' => $validated['body'],
        ]);
    }


    /**
     * The user can update their comment.
     * @param Request $request The HTTP request to the server.
     * @param mixed $id The comment id.
     * @return \Illuminate\Http\RedirectResponse Redirect back to forum page with success message.
     * @throws \Illuminate\Auth\Access\AuthorizationException If the user is not logged in.
     */

    public function update(Request $request, $id)
    {
        // Find the comment by it's ID.
        $comment = Comment::findOrFail($id);

        // Authorise that the user is the person who commented or an admin.
        if (auth()->id() !== $comment->user_id && !auth()->user()->user_admin) {
            abort(403, 'Unauthorized action.');
        }

        // Validate the updated comment.
        $validated = $request->validate([
            'content' => 'required|string|max:1000',
        ]);

        // Update the comment with the new validated data.
        $comment->update($validated);

        // Redirect back to forum page with a success message.
        return back()->with('success', 'Comment updated successfully!');
    }

    /**
     * Deletes a comment from the database.
     * @param mixed $id the comment id.
     * @return \Illuminate\Http\RedirectResponse redirect back to the forum with success message.
     */
    public function delete($id)
    {
        // Locate comment by it's ID.
        $comment = Comment::findOrFail($id);

        // Authorise that the user is the person who commented or an admin.
        if (auth()->id() !== $comment->user_id && !auth()->user()->user_admin) {
            abort(403, 'Unauthorized action.');
        }

        // Delete the comment.
        $comment->delete();

        // Redirect back with success message.
        return back()->with('success', 'Comment deleted successfully!');
    }
}