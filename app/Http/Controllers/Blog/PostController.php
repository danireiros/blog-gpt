<?php

namespace App\Http\Controllers\Blog;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PostController extends Controller
{
    /**
     * Display all posts
     */
    public function index(){
        $posts = Post::with(['category', 'author'])->paginate(10);

        return Inertia('Blog/Index', compact('posts'));
    }
}
