<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Post;
use Inertia\Inertia;
use App\Models\Author;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Requests\Post\Put;
use App\Http\Requests\Post\Store;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        /* $posts = Post::with(['category', 'author'])->paginate(5); */
        $categories = Category::all();
        $authors = Author::all();
        $enumPosted = (new Post())->enumPosted;
        $enumType = (new Post())->enumType;

        // ordenacion
        $sortColumn = request('sortColumn') ?? 'id';
        $sortDirection = request('sortDirection') ?? 'desc';

        $posts = Post::with(['category', 'author'])->orderBy($sortColumn, $sortDirection);

        $filter_author_id = request('author_id');
        $filter_category_id = request('category_id');
        $filter_type = request('type');
        $filter_posted = request('posted');
        $filter_search = request('search');
        $filter_from = request('from');
        $filter_to = request('to');

        if($filter_author_id)
            $posts->where('author_id', $filter_author_id);

        if($filter_category_id)
            $posts->where('category_id', $filter_category_id);

        if($filter_type)
            $posts->where('type', $filter_type);

        if($filter_posted)
            $posts->where('posted', $filter_posted);

        if($filter_search){
            $posts->where(function($query) use ($filter_search) {
                $query->orWhere('title', 'like', '%'.$filter_search.'%');
                $query->orWhere('description', 'like', '%'.$filter_search.'%');
                $query->orWhere('text', 'like', '%'.$filter_search.'%');
            });
        }

        if($filter_from && $filter_to){
            $posts->whereBetween('created_at', [request('from'), request('to')]);
        }

        $posts = $posts->paginate(5);

        return Inertia::render('Dashboard/Post/Index', compact(
            'sortColumn', 
            'sortDirection', 
            'posts', 
            'categories', 
            'enumPosted', 
            'enumType', 
            'authors',
            'filter_author_id',
            'filter_category_id',
            'filter_type',
            'filter_posted',
            'filter_search',
            'filter_from',
            'filter_to',
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        $authors = Author::all();
        $enumPosted = (new Post())->enumPosted;
        $enumType = (new Post())->enumType;
        return Inertia::render('Dashboard/Post/Save', compact('categories', 'enumPosted', 'enumType', 'authors'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Store $request)
    {
        $post = Post::create($request->validated());

        if($request->image)
            $this->upload($request, $post);

        /* return Inertia::render('Dashboard/Post/UploadFile', compact('post'))
            ->with('message', 'Post '. $post->title.' creado con exito.'); */

        // En caso de quererlo en la siguiente vista
        return to_route('post.create.upload', $post)->with('message', 'Post '. $post->title.' creado con exito.');
    }

    /**
     * Display the specified resource.
     */
    public function create_file(Post $post)
    {
        return Inertia::render('Dashboard/Post/UploadFile', compact('post'))->with('message', 'Post '. $post->title.' creado con exito.');
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
        $authors = Author::all();
        $post = Post::with(['category', 'author'])->find($post)->first();
        $enumPosted = (new Post())->enumPosted;
        $enumType = (new Post())->enumType;
        //return Inertia::render('Dashboard/Post/Edit', compact('post', 'categories', 'enumPosted', 'enumType'));
        return Inertia::render('Dashboard/Post/Save', compact('post', 'authors', 'categories', 'enumPosted', 'enumType'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Put $request, Post $post)
    {
        $post->update($request->validated());

        if($request->image)
            $this->upload($request, $post);
        
        return to_route('post.index')->with('message', 'Post '. $post->title.' actualizado con exito.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        Storage::disk('public_upload')->delete("image/post/".$post->image);
        $post->delete();
        return to_route('post.index')->with('message', 'Post eliminado con exito.');
    }

    /**
     * Upload Post image to public_path
     */
    public function upload(Request $request, Post $post)
    {
        $request->validate(
            ['image' => 'required|mimes:jpg,jpeg,png,gif|max:10240'],
        );

        Storage::disk('public_upload')->delete("image/post/".$post->image);

        $data['image'] = $filename = time().'.'.$request['image']->extension();

        $request->image->move(public_path('image/post'), $filename);

        $post->update(
            $data
        );

        return to_route('post.index')->with('message', 'Imagen de '. $post->title.' subida con exito.');
    }
}
