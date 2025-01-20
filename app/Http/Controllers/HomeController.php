<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Post;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $posts = Post::select('id', 'recipe_name', 'recipe_description', 'user_id', 'updated_at', 'created_at')
        ->with(['user:id,name']) // Load the user name only
        ->paginate(5); // Paginate recipes, eager load user relationship
        return view('home', compact('posts'));
    }
}
