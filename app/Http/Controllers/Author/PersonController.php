<?php

namespace App\Http\Controllers\Author;

use Inertia\Inertia;
use App\Models\AuthorPerson;
use Illuminate\Http\Request;
use App\Models\AuthorGeneral;
use App\Http\Controllers\Controller;
use App\Http\Requests\Author\Person;

class PersonController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    /* public function index()
    {
        
    } */

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $authors = AuthorGeneral::get();
        $enumChoices = (new AuthorPerson())->enumChoices;
        return Inertia('Author/Person/Form', compact('enumChoices', 'authors'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Person $request)
    {
        $authorPerson = AuthorPerson::create($request->validated());
        return to_route('author-general.edit', ['author_general' => $authorPerson->general->id]);
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
    public function edit(AuthorPerson $authorPerson)
    {
        $enumChoices = (new AuthorPerson())->enumChoices;
        $authors = AuthorGeneral::get();
        return Inertia('Author/Person/Form', compact('authorPerson', 'authors', 'enumChoices'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Person $request, AuthorPerson $authorPerson)
    {
        $authorPerson->update($request->validated());
        return to_route('author-general.edit', ['author_general' => $authorPerson->general->id]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
