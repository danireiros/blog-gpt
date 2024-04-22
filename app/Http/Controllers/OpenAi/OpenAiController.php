<?php

namespace App\Http\Controllers\OpenAi;

use App\Models\Post;
use Inertia\Inertia;

use App\Models\Author;
use GuzzleHttp\Client;

use Illuminate\Http\Request;
use App\Models\OpenAiChatModel;
use App\Models\OpenAiImageModel;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Tools\ImageController;

class OpenAiController extends Controller
{
    /**
     * Display the index
     */
    public function index(){
        $textModels = OpenAiChatModel::all();
        $imageModels = OpenAiImageModel::all();
        $usedTextModel = OpenAiChatModel::where('using', 1)->pluck('name')->first();
        $usedImageModel = OpenAiImageModel::where('using', 1)->pluck('name')->first();

        return Inertia('Dashboard/OpenAi/Index', compact('textModels', 'imageModels', 'usedTextModel', 'usedImageModel'));
    }

    /**
     * Llamar a la api de chat de openai y recibir mensaje
     */
    public function postChatCompletion(
        $model,
        $systemPrompt = null,
        $userPromt = null,
        $maxTokens = 1200,
        $temp = 0.8,
    ){
        $client = new Client();
        $response = $client->post('https://api.openai.com/v1/chat/completions', [
            'headers' => [
                'Authorization' => 'Bearer '.env('OPENAI_API_KEY', null),
                'Content-Type' => 'application/json',
            ],
            'json' => [
                "model" => "$model->model_name",
                "messages" => [
                    [
                        "role" => "system",
                        "content" => "$systemPrompt"
                    ],
                    [
                        "role" => "user",
                        "content" => "$userPromt"
                    ]
                ],
                "temperature" => $model->temperature,
                "max_tokens" => $model->max_tokens,
                "top_p" => 1
            ],
        ]);

        $jsonResponse = $response->getBody()->getContents();
        $responseArray = json_decode($jsonResponse, true);
        $content = $responseArray['choices'][0]['message']['content'];

        return $content;
    }

    /**
     * Llamar a la api de imagen de openai y recibir mensaje
     */
    public function postImageGeneration($prompt, $model){
        $client = new Client();

        $content = strip_tags($prompt);
        $content = str_replace(['"', "'"], '', $content);

        $response = $client->post('https://api.openai.com/v1/images/generations', [
            'headers' => [
                'Authorization' => 'Bearer '.env('OPENAI_API_KEY', null),
                'Content-Type' => 'application/json',
            ],
            'json' => [
                "model" => $model->model_name,
                "prompt" => $prompt,
                "n" => 1,
                "size" => $model->size
            ],
        ]);

        $jsonResponse = $response->getBody()->getContents();
        $data = json_decode($jsonResponse, true);
        $imageUrl = $data['data'][0]['url'];

        $imageController = new ImageController();
        $filename = $imageController->storeImageFromUrl($imageUrl);

        return $filename;
    }
}
