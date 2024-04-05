<?php

namespace App\Http\Controllers\Blog;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Ramsey\Uuid\Type\Integer;

class PostController extends Controller
{
    /**
     * Display all posts
     */
    public function index(){
        $posts = Post::with(['category', 'author'])->where('posted', true)->orderBy('created_at', 'desc')->paginate(11);

        $categories = Category::all();
        return Inertia('Blog/Index', compact('posts', 'categories'));
    }

    /**
     * Display all posts
     */
    public function category($category){
        $category = Category::where('title', $category)->first();
        $posts = Post::with(['category', 'author'])
            ->where('posted', true)
            ->where('category_id', $category->id)
            ->orderBy('id', 'desc')
            ->paginate(11);

        $categories = Category::all();
        return Inertia('Blog/Index', compact('posts', 'categories'));
    }

    /**
     * Muestra un post
     */
    public function show($slug) {
        $post = Post::with('category','author')
            ->where('slug', $slug)
            ->first();

        $categories = Category::all();
        return Inertia('Blog/Post/Index', compact('post', 'categories'));
    }
}
