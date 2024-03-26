<?php

namespace App\Http\Controllers\Tools;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class TextController extends Controller
{
    public function getWords($content, $words){
        $maxLengthWords = $words;
        $content = strip_tags($content);
        $words = $this->splitWords($content);
        if (count($words) > $maxLengthWords) {
            $words = array_slice($words, 0, $maxLengthWords);
            $content = implode(' ', $words);
        }
        return $content;
    }

    function splitWords($text) {
        preg_match_all('/\b[\p{L}\'\-.]+\b/u', $text, $matches);
        return $matches[0];
    }
}
