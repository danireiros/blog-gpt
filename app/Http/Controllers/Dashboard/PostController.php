<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Post;
use Inertia\Inertia;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Requests\Post\Put;
use App\Http\Requests\Post\Store;
use App\Http\Controllers\Controller;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::with('category')->paginate(2);
        return Inertia::render('Dashboard/Post/Index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        $enumPosted = (new Post())->enumPosted;
        $enumType = (new Post())->enumType;
        return Inertia::render('Dashboard/Post/Save', compact('categories', 'enumPosted', 'enumType'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Store $request)
    {
        Post::create($request->validated());
        return to_route('post.index')->with('message', 'Post '. $request->title.' creado con exito.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        $categories = Category::all();
        $post = Post::with('category')->find($post)->first();
        $enumPosted = (new Post())->enumPosted;
        $enumType = (new Post())->enumType;
        return Inertia::render('Dashboard/Post/Save', compact('post', 'categories', 'enumPosted', 'enumType'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Put $request, Post $post)
    {
        $post->update($request->validated());
        return to_route('post.index')->with('message', 'Post '. $post->title.' actualizado con exito.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return to_route('post.index')->with('message', 'Post eliminado con exito.');;
    }
}
