<?php
namespace App\Services;

use Illuminate\Support\Facades\Storage;

class ImageService {
    public function base64($photos_64)
    {
        $extension = explode('/', mime_content_type($photos_64))[1]; //type jpeg
        $imageName = bin2hex(random_bytes(5))  . '.' . $extension; //random name
        $replace_data = str_replace('data:image/jpeg;base64,', '', $photos_64); //remplace vide information
        $resultat = str_replace(' ', '+', $replace_data); //remplace plus espace
        return [
            'image' => $resultat,
            'filename' => $imageName
        ];
    }
}