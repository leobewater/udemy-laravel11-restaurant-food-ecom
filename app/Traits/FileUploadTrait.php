<?php

namespace App\Traits;

use Illuminate\Http\Request;

trait FileUploadTrait
{
    public function uploadImage(Request $request, string $inputName, string $path = "/uploads")
    {
        if($request->hasFile($inputName)) {
            $image = $request->file($inputName);
            $ext = $image->getClientOriginalExtension();
            $imageName = 'media_' . uniqid() . '.' . $ext;
            $image->move(public_path($path), $imageName);

            return $path . '/' . $imageName;
        }
    }
}
