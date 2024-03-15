<?php

namespace App\Http\Controllers\Web;

use App\Models\Web;
use App\Models\Post;

use App\Models\Author;
use GuzzleHttp\Client;
use App\Models\PostLog;
use App\Http\Controllers\Controller;
use App\Http\Controllers\OpenAi\PostController;

class SoymotorController extends Controller
{
    /**
     * Generar noticias
     */
    public function GenerateWebPost($webName){
        $web = Web::where('name', $webName)->first();

        $links_found = 0;
        $news_generated = 0;

        $content = $this->getNewsContainer(
            $web->news_container_content_start, 
            $web->news_container_content_end, 
            $web->domain, 
            $web->news_subdomain
        );

        if($content){
            $links = $this->getNewsLinks($content, $web->domain);

            foreach ($links as $link) {
                $links_found++;
                $new_content = $this->getNewContent($link);

                if($new_content){
                    $post = $this->generatePost($new_content, $link, $web->category_id);
                    if($post){
                        $news_generated++;
                    }
                }else{

                }
            }

            PostLog::create([
                'domain' => $web->domain,
                'subdomain' => $web->news_subdomain,
                'posts_found' => $links_found,
                'posts_generated' => $news_generated,
            ]);

            return to_route('web.index')->with('fixedmessage', "Generación con éxito: 
                links = $links_found
                posts generados = $news_generated");
        }else{
            return to_route('web.index')->with('fixedmessage', 'No hay contenido para generar');
        }
            
    }

    /**
     * Obtener el container de las noticias
     */
    public function getNewsContainer($start, $end, $domain,  $newsDomain){
        $pattern = '/' . preg_quote($start, '/') . '(.*?)' . preg_quote($end, '/') . '/s';
        $client = new Client();

        try {
            $response = $client->request('GET', $domain.$newsDomain);
            $body = $response->getBody();
            $data = $body->getContents();

            if (preg_match($pattern, $data, $matches)) {
                $content = $matches[1];
                return $content;
            } else {
                return null;
            }

        } catch (\GuzzleHttp\Exception\RequestException $e) {
            return null;
        }
    }

    /**
     * Obtener links de las noticias
     */
    public function getNewsLinks($content, $domain){
        $hrefPattern = '/<a[^>]+href="([^"]+)"/s';

        //$hrefPattern = '/<a[^>]+href="\/f1\/noticias\/([^"]+)"/s';
        preg_match_all($hrefPattern, $content, $hrefMatches);

        $hrefValues = $hrefMatches[1] ?? [];
        $links = [];

        foreach ($hrefValues as $href) {
            $link = str_replace('\\', '', $domain.$href);
            if (strpos($link, '/user/') === false) {
                array_push($links, $link);
            } 
            
        }

        $links = $this->removeDuplicatedLinks($links);

        return $links;
    }

    /**
     * Eliminar links duplicados
     */
    public function removeDuplicatedLinks($links){
        return array_unique($links);
    }

    /**
     * Eliminar links duplicados
     */
    public function getNewContent($link){
        $start = '<h1 class="page-title">';
        $end = '<div class="content-sidebar">';
        $pattern = '/'. preg_quote($start, '/') . '(.*?)' . preg_quote($end, '/') . '/s';

        $client = new Client();

        try {
            $response = $client->request('GET', $link);
            $body = $response->getBody();
            $data = $body->getContents();

            if (preg_match($pattern, $data, $matches)) {
                $content = $matches[1];
                $textPattern = '/<p[^>]*>(.*?)<\/p>/s';
                preg_match_all($textPattern, $content, $textMatches);
                $textValues = $textMatches[1] ?? [];
                $content = '';

                foreach ($textValues as $text) {
                    $content .= strip_tags($text) . PHP_EOL;
                }

                return $content;
            }else{
                return null;
            }
        } catch (\GuzzleHttp\Exception\RequestException $e) {
            return null;
        }
    }

    /**
     * Generar Post
     */
    public function generatePost($content, $link, $category_id){
        $author = Author::where('category_id', $category_id)->inRandomOrder()->first();

        $slug = strrchr($link, '/');
        if ($slug !== false) {
            $slug = substr($slug, 1);
        }

        $isPost = Post::where('slug', $slug)->first();

        if(!$isPost){
            $OpenaiPostController = new PostController();
            $OpenaiPostController->postCompletion('gpt-4-0125-preview', $author, $content, $slug);
            sleep(10);
            return 1;
        }
        return null;
    }
}
