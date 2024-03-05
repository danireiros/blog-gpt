<?php

namespace App\Http\Controllers\Author;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Models\AuthorGeneral;
use App\Http\Controllers\Controller;
use App\Http\Requests\Author\General;
use Illuminate\Support\Facades\Storage;

class GeneralController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $authors = AuthorGeneral::paginate(2);
        return Inertia('Author/Index', compact('authors'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $enumType = (new AuthorGeneral())->enumType;
        return Inertia('Author/General/Form', compact('enumType'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(General $request)
    {
        AuthorGeneral::create($request->validated());
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
    public function edit(AuthorGeneral $authorGeneral)
    {
        $enumType = (new AuthorGeneral())->enumType;
        return Inertia('Author/General/Form', compact('authorGeneral', 'enumType'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(General $request, AuthorGeneral $authorGeneral)
    {
        $authorGeneral->update($request->validated());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
