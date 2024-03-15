<?php

namespace App\Http\Controllers\Blog;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Ramsey\Uuid\Type\Integer;

class PostController extends Controller
{
    /**
     * Display all posts
     */
    public function index(){
        $posts = Post::with(['category', 'author'])->where('posted', true)->orderBy('id', 'desc')->paginate(11);

        return Inertia('Blog/Index', compact('posts'));
    }

    /**
     * Muestra un post
     */
    public function show($post_id) {
        $post = Post::with('category','author')->find($post_id);
        return Inertia('Blog/Post/Index', compact('post'));
    }
}
