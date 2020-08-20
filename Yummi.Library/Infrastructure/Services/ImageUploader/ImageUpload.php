<?php
declare(strict_types=1);
namespace Yummi\Infrastructure\Services\ImageUploader;

use RuntimeException;

class ImageUpload
{
    public static function Upload(string $path, string $image_ref) : string
    {
        if (request()->hasFile($image_ref)){
            $imageUpl = request()->file($image_ref);
            if (!is_array(getimagesize($imageUpl))){
                throw new RuntimeException("You isn't insert image, please insert image.");
            }
            $ext = $imageUpl->extension();
            $imageName = time().$ext;
            $imageUpl->move(public_path($path.$imageName));
            return $path.$imageName;
        }

        throw new RuntimeException("Image upload isn't found.");
    }
}