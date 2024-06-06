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
        $search_term = request()->query('search_term');

        
        $posts = Post::With(['user', 'categories'])->where('title', 'LIKE', '%' . $search_term . '%')->orderBy('created_at', 'desc')->get();
        return view('home', compact('posts', 'search_term'));
    }
}
