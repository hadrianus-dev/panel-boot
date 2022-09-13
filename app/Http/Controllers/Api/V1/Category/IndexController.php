<?php

namespace App\Http\Controllers\Api\V1\Category;


use Illuminate\Http\Request;

use Domain\Category\Models\Category;
use Illuminate\Http\JsonResponse;
use JustSteveKing\StatusCode\Http;
use App\Http\Controllers\Controller;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;
use App\Http\Resources\Api\V1\Category\CategoryResource;

class IndexController extends Controller
{
    public function __invoke(Request $request): JsonResponse
    {
        $Categories = QueryBuilder::for(
            subject: Category::class,
        )->allowedFilters(
            [
                AllowedFilter::scope('published'),
                AllowedFilter::scope('draft'),
            ]
        )->get();

        return response()->json(
            data: CategoryResource::collection(
                resource: $Categories,
            ),
            status: 200
        );
    }
}
