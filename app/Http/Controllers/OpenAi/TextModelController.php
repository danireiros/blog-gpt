<?php

namespace App\Http\Controllers\OpenAi;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Models\OpenAiChatModel;
use App\Http\Controllers\Controller;
use App\Http\Requests\OpenAi\Text\Put;
use App\Http\Requests\OpenAi\Text\Store;

class TextModelController extends Controller
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
        return Inertia::render('Dashboard/OpenAi/Text/Save');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Store $request)
    {
        $model = OpenAiChatModel::create($request->validated());
        return to_route('openai.index')->with('message', 'Modelo de texto '. $model->name.' añadido con exito.');
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
    public function edit(OpenAiChatModel $text)
    {
        return Inertia::render('Dashboard/OpenAi/Text/Save', compact('text'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Put $request, OpenAiChatModel $text)
    {
        $text->update($request->validated());
        return to_route('openai.index')->with('message', 'Modelo de texto '. $text->name.' actualizado con exito.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(OpenAiChatModel $text)
    {
        $text->delete();
        return to_route('openai.index')->with('message', 'Modelo de texto eliminado con exito.');
    }

    /**
     * Set used model
     */
    public function setTextModel(OpenAiChatModel $text)
    {
        OpenAiChatModel::query()->update(['using' => 0]);
        $text->update([
            'using' => true
        ]);
        return to_route('openai.index')->with('message', "Usando $text->name como modelo de texto");
    }
}
