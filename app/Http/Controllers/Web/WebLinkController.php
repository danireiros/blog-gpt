<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\WebLink;
use Illuminate\Http\Request;

class WebLinkController extends Controller
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
    public function store($data)
    {
        WebLink::create($data);
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
    public function destroy(WebLink $weblink)
    {
        $weblink->delete();
        return to_route('web.index')->with('message', 'Link eliminado con exito.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroyAll()
    {
        WebLink::truncate();
        return to_route('web.index')->with('message', 'Links eliminados con exito.');
    }
}
