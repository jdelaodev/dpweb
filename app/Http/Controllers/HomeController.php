<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::With(['user', 'categories'])->orderBy('created_at', 'desc')->get();
        return view('home', compact('posts'));
    }
}
