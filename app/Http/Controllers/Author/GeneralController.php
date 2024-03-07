<?php

namespace App\Http\Controllers\Author;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Models\AuthorCompany;
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
        Inertia::share('step', getStep());
        $enumType = (new AuthorGeneral())->enumType;
        return Inertia('Author/General/Step', compact('enumType'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(General $request)
    {
        $authorGeneral = AuthorGeneral::create($request->validated());
        return to_route('author-general.edit', ['author_general' => $authorGeneral]);
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
        Inertia::share('step', getStep($authorGeneral));

        $authorGeneral->company;
        $authorGeneral->person;
        $authorGeneral->detail;

        if(!$authorGeneral->company){
            unset($authorGeneral->company);
        }

        if(!$authorGeneral->person){
            unset($authorGeneral->person);
        }

        if(!$authorGeneral->detail){
            unset($authorGeneral->detail);
        }

        $enumType = (new AuthorGeneral())->enumType;
        $enumChoices = (new AuthorCompany())->enumChoices;
        $authors = AuthorGeneral::get();
        return Inertia('Author/General/Step', compact('authorGeneral', 'enumType', 'enumChoices', 'authors'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(General $request, AuthorGeneral $authorGeneral)
    {
        $authorGeneral->update($request->validated());
        /* return back(); */
        return to_route('author-general.edit', ['author_general' => $authorGeneral]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
