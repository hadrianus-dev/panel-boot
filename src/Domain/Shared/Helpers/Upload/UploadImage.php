<?php

declare(strict_types=1);

namespace Domain\Shared\Helpers\Upload;

use Illuminate\Support\Str;
use Domain\Shared\Helpers\TypeFile\ImageValidateType;
 
trait UploadImage
{
    public function ImageUpload(ImageValidateType $Image, string $titleImage = null, 
    string $pathImage = null): String
    {
        #dd($Image);
        (!$titleImage) ? $titleImage = Str::random(10) : $titleImage;
        $getExtension = strtolower($Image->getClientOriginalExtension()); 
        $ImageFullName = strtolower($titleImage .'-'. uniqid().'.'. $getExtension);
        $mountPathImage = ($pathImage !== null) ? 'images/'.$pathImage : 'images/';   
        $theImagePath = $mountPathImage.$ImageFullName;
        $success = $Image->storeAs($mountPathImage, $ImageFullName);
 
        return $theImagePath; // Just return image
    }
}
