<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Comment;

class CommentsController extends Controller
{
    public function create(Request $request, $post_id)
    {
        $request->validate([
            'content' => 'required|string'
        ]);

        Comment::create([
            'content' => $request->content,
            'user_id' => Auth::user()->id,
            'post_id' => $post_id
        ]);

        return redirect()->route('user.posts.show', $post_id);
    }

    public function destroy($post_id, $id)
    {
        $comment = Comment::where(['post_id' => $post_id, 'user_id' => Auth::user()->id])->findOrFail($id);
        $comment->delete();
        return redirect()->route('user.posts.show', $post_id);
    }
}
