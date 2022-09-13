<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1\Category;

use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Domain\Category\Jobs\CreateCategory;
use Domain\Category\Factory\CategoryFactory;
use App\Http\Requests\Api\V1\Category\StoreRequest;

class StoreController extends Controller
{
    public function __invoke(StoreRequest $request): Response
    {
        CreateCategory::dispatch(
            object: CategoryFactory::create(attributes: $request->validated())
        );
       
        return response(
            content: null,
            status: 202
        );
    }
}
