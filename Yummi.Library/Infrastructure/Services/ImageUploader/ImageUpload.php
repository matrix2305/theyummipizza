<?php
declare(strict_types=1);
namespace Yummi\Infrastructure\Services\ImageUploader;

use Intervention\Image\Facades\Image;
use RuntimeException;

class ImageUpload
{
    public static function Upload(string $path, string $image_ref) : string
    {
        if (request()->has($image_ref)){
            $imageUpl = request()->get($image_ref);
            if (!is_array(getimagesize($imageUpl))){
                throw new RuntimeException("You isn't insert image, please insert image.");
            }
            $image = Image::make($imageUpl);
            $imageName = time().$image->extension;
            $image->save(public_path($path.$imageName));
            return $path.$imageName;
        }

        throw new RuntimeException("Image upload isn't found.");
    }
}