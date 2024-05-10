<?php

namespace App\Http\Controllers\Blog;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Comment;
use Ramsey\Uuid\Type\Integer;

class PostController extends Controller
{
    /**
     * Display all posts
     */
    public function index(){
        $posts = Post::with(['category', 'author'])
            ->withCount('comments')
            ->where('posted', true)
            ->orderBy('created_at', 'desc')
            ->paginate(11);

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

        $comments = Comment::with('user')
            ->where('post_id', $post->id)
            ->orderByRaw('CASE WHEN parent_comment_id IS NULL THEN likes END desc, CASE WHEN parent_comment_id IS NOT NULL THEN created_at END asc')
            ->get();

        if(auth()->id()){
            $user = 'logged';
        }else{
            $user = 'not';
        }

        $categories = Category::all();
        //return Inertia('Blog/Post/Index', compact('post', 'categories', 'comments', 'user'));

        $data = compact('post', 'categories', 'comments', 'user');
        $data['event'] = [
            'url' => 'https://infoparati.es/blog/'.$slug,
            'title' => $post->title,
            'description' => $post->description,
            'image' => 'https://infoparati.es/image/post/'.$post->image,
        ];
        return Inertia('Blog/Post/Index', $data);
    }
}
