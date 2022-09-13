<?php

declare(strict_types=1);

namespace Domain\Category\Actions;

use Domain\Category\Models\Category;
use Domain\Category\ValueObject\CategoryValueObject;

class UpdateCategoryAction
{
    public static function handle(CategoryValueObject $object, Category $Category): bool
    {
        return $Category->update($object->toArray());
    }
}
