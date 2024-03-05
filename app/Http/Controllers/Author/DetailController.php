<?php

namespace App\Http\Controllers\Author;

use Inertia\Inertia;
use App\Models\AuthorDetail;
use Illuminate\Http\Request;
use App\Models\AuthorGeneral;
use App\Http\Controllers\Controller;
use App\Http\Requests\Author\Detail;

class DetailController extends Controller
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
        return Inertia('Author/Detail/Form', compact('authors'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Detail $request)
    {
        AuthorDetail::create($request->validated());
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
    public function edit(AuthorDetail $authorDetail)
    {
        $authors = AuthorGeneral::get();
        return Inertia('Author/Detail/Form', compact('authorDetail', 'authors'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Detail $request, AuthorDetail $authorDetail)
    {
        $authorDetail->update($request->validated());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
