<?php

namespace App\Http\Controllers\Author;

use Illuminate\Http\Request;
use App\Models\AuthorCompany;
use App\Http\Controllers\Controller;
use App\Http\Requests\Author\Company;
use App\Models\AuthorGeneral;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    /* public function index()
    {
        return Inertia('Author/Index');
    } */

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $authors = AuthorGeneral::get();
        $enumChoices = (new AuthorCompany())->enumChoices;
        return Inertia('Author/Company/Form', compact('enumChoices', 'authors'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Company $request)
    {
        AuthorCompany::create($request->validated());
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
    public function edit(AuthorCompany $authorCompany)
    {
        $enumChoices = (new AuthorCompany())->enumChoices;
        $authors = AuthorGeneral::get();
        return Inertia('Author/Company/Form', compact('authorCompany', 'authors', 'enumChoices'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Company $request, AuthorCompany $authorCompany)
    {
        $authorCompany->update($request->validated());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
