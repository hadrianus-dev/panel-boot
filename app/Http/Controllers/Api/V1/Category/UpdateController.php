<?php

namespace App\Http\Controllers\Api\V1\Category;

use Illuminate\Http\Response;
use Domain\Category\Models\Category;
use App\Http\Controllers\Controller;
use Domain\Category\Jobs\UpdateCategory;
use Domain\Category\Factory\CategoryFactory;
use App\Http\Requests\Api\V1\Category\UpdateRequest;

class UpdateController extends Controller
{
    public function __invoke(UpdateRequest $updateRequest, Category $Category): Response
    {
        UpdateCategory::dispatch(
            Category: $Category,
            object: CategoryFactory::create(attributes: $updateRequest->validated())
        );

        $Category->fresh();

        return response(
            content: null, status: 200
        );
    }
}
