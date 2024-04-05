<?php

namespace App\Http\Controllers\Web;

use App\Models\Web;
use App\Models\Post;
use App\Models\Author;
use App\Models\WebLink;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Requests\Web\Put;
use App\Models\OpenAiChatModel;
use App\Http\Requests\Web\Store;
use App\Models\OpenAiImageModel;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Blog\PostController;
use App\Http\Controllers\Dashboard\PostController as DashboardPostController;
use App\Http\Controllers\Tools\ImageController;

class MainController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(){
        $webs = Web::with('category')->get();
        $webLinks = WebLink::with('web')->orderBy('created_at', 'desc')->paginate(10);
        return Inertia('Dashboard/Web/index', compact('webs', 'webLinks'));
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
        if($webname){
            $WebContentController = new WebContentController();
            $WebContentController->generatePostFromWebContent($webname);
        }else{
            return to_route('web.index')->with('message', 'Web '.$webname.' no tiene ruteo asignado. Asigne ruta en web.php');
        }
    }

    /**
     * Generar noticia desde link
     */
    public function generateNewFromLink($link){
        $webLink = WebLink::where('id', $link)->with('web')->first();
        $webContentController = new WebContentController();
        $content = $webContentController->getNewContent($webLink->link, $webLink->web->new_content_start, $webLink->web->new_content_end);
        
        if($content){
            $author = Author::where('category_id', $webLink->web->category_id)->inRandomOrder()->first();

            $slug = strrchr($link, '/');
            if ($slug !== false) {
                $slug = substr($slug, 1);
            }

            if($webLink->status != 'Usado'){
                $postController = new DashboardPostController();
                $imageModel = OpenAiImageModel::where('using', 1)->pluck('model_name')->first();
                $textModel = OpenAiChatModel::where('using', 1)->pluck('model_name')->first();
                $post = $postController->generate($textModel, $imageModel, $webLink->web->style, $author, $content, $slug);
                $webLink->update([
                    'status' => 'Usado'
                ]);
            }

            return to_route('post.edit', $post->id)->with('fixedmessage', "Noticia generada con éxito!");
        }
    }
}
