<?php

namespace Domain\Gallery\Actions;

use Domain\Gallery\Models\Gallery;
use Domain\Gallery\ValueObject\GalleryValueObject;

class CreateGalleryAction
{
    public static function handle(GalleryValueObject $object): Gallery
    {
        return Gallery::create($object->toArray());
    }
}
