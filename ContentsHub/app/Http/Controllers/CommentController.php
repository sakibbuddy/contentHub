<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request, Post $post)
    {
        $validated = $request->validate([
            'content' => 'required|max:1000'
        ]);

        $comment = $post->comments()->create([
            'user_id' => Auth::id(),
            'content' => $validated['content']
        ]);

        // Notify the post author of the new comment
        if ($post->user_id !== Auth::id()) {
            $post->user->notifications()->create([
                'type' => 'new_comment',
                'data' => [
                    'post_id' => $post->id,
                    'post_title' => $post->title,
                    'comment_id' => $comment->id,
                    'commenter_name' => Auth::user()->name
                ]
            ]);
        }

        return back()->with('success', 'Comment posted successfully.');
    }

    public function destroy(Comment $comment)
    {
        if (Auth::id() !== $comment->user_id && Auth::id() !== $comment->post->user_id) {
            abort(403);
        }

        $comment->delete();

        return back()->with('success', 'Comment deleted successfully.');
    }
}