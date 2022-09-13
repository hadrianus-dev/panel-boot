<?php

declare(strict_types=1);

namespace Domain\Gallery\Actions;

use Domain\Gallery\Models\Gallery;
use Domain\Gallery\ValueObject\GalleryValueObject;

class UpdateGalleryAction
{
    public static function handle(GalleryValueObject $object, Gallery $Gallery): bool
    {
        return $Gallery->update($object->toArray());
    }
}
