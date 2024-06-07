<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Comment;
use App\Models\ReactionType;
use App\Models\Reaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $post = Post::with('user')->findOrFail($id);
        $comments = Comment::where('post_id', $id)->with('user')->get();
        $comments_count = $comments->count();
        $likes_count = Reaction::where(['reaction_type_id' => ReactionType::where(['slug' => 'like'])->first()->id, 'post_id' => $post->id])->count();
        $dislikes_count = Reaction::where(['reaction_type_id' => ReactionType::where(['slug' => 'dislike'])->first()->id, 'post_id' => $post->id])->count();
        $current_user_reaction = Reaction::where(['user_id' => Auth::user()->id, 'post_id' => $post->id])->with(['reaction_type'])->first();

        return view('posts.show', compact('post', 'comments', 'comments_count', 'likes_count', 'dislikes_count', 'current_user_reaction'));
    }
}
