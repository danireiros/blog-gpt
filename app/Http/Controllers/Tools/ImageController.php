<?php

namespace App\Http\Controllers\Tools;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    /**
     * store image from given url
     */
    public function storeImageFromUrl($url, $folder = '/image/post/',$extension = 'jpg')
    {
        $imageUrl = $url;
        $client = new Client();
        $response = $client->get($imageUrl);
        $filename = time().uniqid().'.'.$extension;

        if ($response->getStatusCode() == 200) {
            $imageContent = $response->getBody()->getContents();
            Storage::disk('public_upload')->put($folder . $filename, $imageContent);
        } else {
            return 'default/default_no_image.jpg';
        }

        return $filename;
    }

    /**
     * Upload Post image to public_path
     */
    public function upload($request, $model, $modelname)
    {
        $request->validate(
            ['image' => 'required|mimes:jpg,jpeg,png,gif,svg,html|max:10240'],
        );

        if (app()->environment('local')) {
            Storage::disk('public_upload')->delete("image/$modelname/".$model->image);
        } else {
            $filePath = public_path("image/$modelname/".$model->image);
            Storage::disk('local')->delete($filePath);
        }

        $data['image'] = $filename = time().'.'.$request['image']->extension();

        if (app()->environment('local')) {
            $request->image->move(public_path("image/$modelname"), $filename);
        } else {
            $request->image->move(base_path('public_html/image/'.$modelname.'/'), $filename);
        }

        $model->update(
            $data
        );

        return to_route('post.index')->with('message', 'Imagen subida con exito.');
    }
}
