<?php

namespace Domain\Category\Actions;

use Domain\Category\Models\Category;
use Domain\Category\ValueObject\CategoryValueObject;

class CreateCategoryAction
{
    public static function handle(CategoryValueObject $object): Category
    {
        return Category::create($object->toArray());
    }
}
