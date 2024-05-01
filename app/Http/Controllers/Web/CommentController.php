<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Comment;
use App\Http\Requests\Comment\Store;

class CommentController extends Controller
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
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Store $request)
    {
        $validated = $request->validated();

        $request->validate(
            ['post_id' => 'required'],
        );

        $comment = new Comment();
        $comment->text = $validated['text'];
        $comment->user_id = auth()->id();
        $comment->post_id = $validated['post_id'];
        $comment->save();

        // Enviar una respuesta JSON para Inertia.js
        return redirect()->back()->with('message', 'Comentario enviado con éxito.');
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
