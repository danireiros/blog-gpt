<?php

namespace App\Http\Controllers\OpenAi;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Models\OpenAiImageModel;
use App\Http\Controllers\Controller;
use App\Http\Requests\OpenAi\Image\Put;
use App\Http\Requests\OpenAi\Image\Store;

class ImageModelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Dashboard/OpenAi/Image/Save');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Store $request)
    {
        $model = OpenAiImageModel::create($request->validated());
        return to_route('openai.index')->with('message', 'Modelo de imagen '. $model->name.' añadido con exito.');
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
    public function edit(OpenAiImageModel $image)
    {
        return Inertia::render('Dashboard/OpenAi/Image/Save', compact('image'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Put $request, OpenAiImageModel $image)
    {
        $image->update($request->validated());
        return to_route('openai.index')->with('message', 'Modelo de texto '. $image->name.' actualizado con exito.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(OpenAiImageModel $image)
    {
        $image->delete();
        return to_route('openai.index')->with('message', 'Modelo de imagen eliminado con exito.');
    }

    /**
     * Set used model
     */
    public function setImageModel(OpenAiImageModel $image)
    {
        OpenAiImageModel::query()->update(['using' => 0]);
        $image->update([
            'using' => true
        ]);
        return to_route('openai.index')->with('message', "Usando $image->name como modelo de imagen");
    }
}
