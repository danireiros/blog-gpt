<?php

namespace App\Http\Controllers\Web;

use App\Models\Web;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Requests\Web\Put;
use App\Http\Requests\Web\Store;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Tools\ImageController;

class MainController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(){
        $webs = Web::with('category')->paginate(10);
        return Inertia('Dashboard/Web/index', compact('webs'));
    }

    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return Inertia('Dashboard/Web/Save', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Store $request)
    {
        $web = Web::create($request->validated());

        if($request->image){
            $imageController = new ImageController();
            $imageController->upload($request, $web, 'web');
        }
        
        return to_route('web.index')->with('message', 'Web '. $web->name.' añadida con exito.');
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
    public function edit(Web $web)
    {
        $categories = Category::all();
        return Inertia('Dashboard/Web/Save', compact('web', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Put $request, Web $web)
    {
        $web->update($request->validated());

        if($request->image){
            $imageController = new ImageController();
            $imageController->upload($request, $web, 'web');
        }
        
        return to_route('web.index')->with('message', 'Web '. $web->name.' actualizada con exito.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    /**
     * Ruteo de webs para generar noticias
     */
    public function routeWeb($webname){
        if($webname == 'SoyMotor' || $webname == 'SoyMotor_Coches'){
            $soyMotorController = new SoymotorController();
            $soyMotorController->GenerateWebPost($webname);
        }elseif($webname == 'Xataka' || $webname == 'XatakaMovil' || $webname == 'VidaExtra' || $webname == 'Espinof'){
            $xatakaController = new XatakaController();
            $xatakaController->GenerateWebPost($webname);
        }else{
            return to_route('web.index')->with('message', 'Web '.$webname.' no tiene ruteo asignado. Asigne ruta en web.php');
        }

    }
}
