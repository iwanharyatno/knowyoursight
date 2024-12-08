<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    public function show($path) {
        $img = Storage::disk('google')->get($path);
        $ext = explode('.', $path)[1];
        return response($img)->header('Content-type', 'image/' . $ext);
    }
}
