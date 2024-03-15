<?php

namespace App\Http\Controllers\OpenAi;

use App\Models\Post;
use Inertia\Inertia;

use App\Models\Author;
use GuzzleHttp\Client;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Tools\ImageController;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display the index
     */
    public function index(){
        return Inertia('Dashboard/OpenAi/Index');
    }

    /**
     * 
     */
    public function postCompletion($model = 'gpt-4-0125-preview', $author = null, $text = null, $slug = null){
        // autor y texto aleatorio
        if(!$author){
            $author = Author::inRandomOrder()->with('category')->first();
        }
        
        $categoryTitle = $author->category->title;
        $client = new Client();

        $pnum = mt_rand(4,7);

        $system_prompt = "$author->system_prompt. Reinterpreta la siguiente noticia a tu manera usando parrafos de maximo 5 lineas que sean cortos, el titulo en <h2> y $pnum parrafos metidos en sus <p class='mb-8'>, destaca las palabras importantes en negrita usando <span class='font-bold'>.";
        if(!$text){
            $text = "Escribe un articulo sobre $author->subcategory";
        }

        $response = $client->post('https://api.openai.com/v1/chat/completions', [
            'headers' => [
                'Authorization' => 'Bearer '.env('OPENAI_API_KEY', null),
                'Content-Type' => 'application/json',
            ],
            'json' => [
                "model" => "$model",
                "messages" => [
                    [
                        "role" => "system",
                        "content" => "$system_prompt"
                    ],
                    [
                        "role" => "user",
                        "content" => "$text"
                    ]
                ],
                "temperature" => 0.8,
                "max_tokens" => 1200,
                "top_p" => 1
            ],
        ]);

        $jsonResponse = $response->getBody()->getContents();
        $responseArray = json_decode($jsonResponse, true);
        $content = $responseArray['choices'][0]['message']['content'];

        $post = $this->generatePost($author, $content, $slug);

        return $post;
    }

    public function postImageGeneration($authorSubcategory, $content){
        $client = new Client();

        $content = strip_tags($content);
        $content = str_replace(['"', "'"], '', $content);

        $response = $client->post('https://api.openai.com/v1/images/generations', [
            'headers' => [
                'Authorization' => 'Bearer '.env('OPENAI_API_KEY', null),
                'Content-Type' => 'application/json',
            ],
            'json' => [
                "model" => "dall-e-3",
                "prompt" => "Imagen estilo comic de $authorSubcategory y $content, sin texto ni letras.",
                "n" => 1,
                "size" => "1024x1024"
            ],
        ]);

        $jsonResponse = $response->getBody()->getContents();
        $data = json_decode($jsonResponse, true);
        $imageUrl = $data['data'][0]['url'];

        $imageController = new ImageController();
        $filename = $imageController->storeImageFromUrl($imageUrl);

        return $filename;
    }

    /**
     * Crear post a partir de la respuesta de openai
     */
    public function generatePost(Author $author, $content, $slug){
        if (preg_match('/<h2>(.*?)<\/h2>/', $content, $matches)) {
            $title = $matches[1];
        } else {
            $title = substr(strip_tags($content), 0, 255);
        }

        if(!$slug){
            $slug = Str(substr($title, 0, 100))->slug();
        }

        $pattern = '/<h2[^>]*>.*?<\/h2>/si';
        $content = preg_replace($pattern, '', $content);
        $content = str_replace('**', '', $content);

        $data = [
            'title' => strip_tags($title),
            'slug' => $slug,
            'text' => $content,
            'description' => substr($content, 0, 255),
            'image' => $this->postImageGeneration($author->subcategory, substr($content, 0, 255)),
            'posted' => true,
            'type' => 'post',
            'category_id' => $author->category->id,
            'author_id' => $author->id,
        ];

        $post = Post::create($data);
        return $post;
    }
}
