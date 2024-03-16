<?php

namespace App\Http\Controllers\Dashboard;

use Inertia\Inertia;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Requests\Category\Put;
use App\Http\Controllers\Controller;
use App\Http\Requests\Category\Store;
use App\Http\Controllers\Tools\ImageController;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::paginate(20);
        return Inertia::render('Dashboard/Category/Index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Dashboard/Category/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Store $request)
    {
        $category = Category::create($request->validated());

        if($request->image){
            $imageController = new ImageController();
            $imageController->upload($request, $category, 'category');
        }

        return to_route('category.index')->with('message', 'Categoría '. $request->title.' actualizada con exito.');
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
    public function edit(Category $category)
    {
        return Inertia::render('Dashboard/Category/Edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Put $request, Category $category)
    {
        $category->update($request->validated());

        if($request->image){
            $imageController = new ImageController();
            $imageController->upload($request, $category, 'category');
        }

        return to_route('category.index')->with('message', 'Categoría '. $category->title.' actualizada con exito.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return to_route('category.index')->with('message', 'Categoría eliminada con exito.');;
    }
}

