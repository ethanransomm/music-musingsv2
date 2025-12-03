<?php

namespace App\Http\Controllers;
use App\Models\Comment;
use App\Models\Rate;
use App\Notifications\CommentNotification;

use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, $id)
{
    
    $request->validate([
        'body' => 'required|max:500'
    ]);

    $rate = Rate::findOrFail($id);

    $comment = Comment::create([
        'user_id' => auth()->id(),
        'rate_id' => $id,
        'content' => $request->body, 
    ]);
    if (auth()->id() !== $rate->user_id) {
        $poster = $rate->user; 
        $poster->notify(new CommentNotification(auth()->user()->name, $rate->album->title));
    }

    return response()->json([
        'success' => true,
        'user' => auth()->user()->name,
        'body' => $comment->content,
        'created_at' => $comment->created_at->diffForHumans()
    ]);
}

      public function delete($id) {
        $comment = Comment::findOrFail($id);
        $user = auth()->user();
        if (!$user) {
        return response()->json(['error' => 'Unauthenticated.'], 401);
        } 
        
        if ($user->user_admin !== true && $user->id !== $comment->user_id) {
        return response()->json(['error' => 'Forbidden.'], 403);
        } else {
             $comment->delete();
             return redirect()->route('forum.index')->with('success', 'Comment deleted successfully!');
        }
       
    }

}
