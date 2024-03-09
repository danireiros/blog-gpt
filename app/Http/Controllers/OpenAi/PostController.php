<?php

namespace App\Http\Controllers\OpenAi;

use Inertia\Inertia;
use App\Models\Author;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

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
    public function postCompletion($model = 'gpt-4-0125-preview', $author = null, $text = null){

        // autor y texto aleatorio
        $author = Author::inRandomOrder()->first();

        $client = new Client();

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
                        "content" => "Eres un periodista $author->system_prompt que habla sobre $author->subcategory. Narrar como si fuese una noticia real, el titulo en <h2 class='font-bold text-xl mb-3'> y dos parrafos metidos en sus <p class='mb-3'>, destaca algunas palabras en negrita usando <span class='font-semibold'>."
                    ],
                    [
                        "role" => "user",
                        "content" => "Escribe un articulo sobre una carrera de Formula 1"
                    ]
                ],
                "temperature" => 0.8,
                "max_tokens" => 500,
                "top_p" => 1
            ],
        ]);

        $jsonResponse = $response->getBody()->getContents();
        $responseArray = json_decode($jsonResponse, true);
        $content = $responseArray['choices'][0]['message']['content'];

        return Inertia('Dashboard/OpenAi/Index', compact('content', 'author'));

        // to-do
        // retornar solo el contenido del mensaje (autor y resto lo tendremos del paso anterior)
    }
}
