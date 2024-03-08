<?php

namespace App\Http\Controllers\Dashboard;

use Inertia\Inertia;
use App\Models\Author;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Requests\Author\Put;
use App\Http\Requests\Author\Store;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $authors = Author::with('category')->paginate(5);
        return Inertia('Dashboard/Author/Index', compact('authors'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        /* $enumType = (new Author())->enumType; */
        return Inertia::render('Dashboard/Author/Save', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Store $request)
    {
        $author = Author::create($request->validated());

        if($request->image)
            $this->upload($request, $author);
        
        return to_route('author.index')->with('message', 'Autor '. $author->name.' creado con exito.');
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
    public function edit(Author $author)
    {
        $categories = Category::all();
        $author = Author::with('category')->find($author)->first();
        /* $enumType = (new Author())->enumType; */
        return Inertia::render('Dashboard/Author/Save', compact('author', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Put $request, Author $author)
    {
        $author->update($request->validated());

        if($request->image)
            $this->upload($request, $author);
        
        return to_route('author.index')->with('message', 'Autor '. $author->title.' actualizado con exito.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    /**
     * Upload Post image to public_path
     */
    public function upload(Request $request, Author $author)
    {
        $request->validate(
            ['image' => 'required|mimes:jpg,jpeg,png,gif|max:10240'],
        );

        Storage::disk('public_upload')->delete("image/author/".$author->image);

        $data['image'] = $filename = time().'.'.$request['image']->extension();

        $request->image->move(public_path('image/author'), $filename);

        $author->update(
            $data
        );

        return to_route('post.index')->with('message', 'Imagen de '. $author->title.' subida con exito.');
    }
}
