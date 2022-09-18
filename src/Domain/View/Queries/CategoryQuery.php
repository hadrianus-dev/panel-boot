<?php

declare(strict_types=1);

namespace Domain\View\Queries;

use Domain\Category\Models\Category;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;
use App\Http\Resources\Api\V1\Category\CategoryResource;
use Illuminate\Http\JsonResponse;
use Infrastructure\View\Queries\CategoryQueryContract;

class CategoryQuery implements CategoryQueryContract
{
    public function handle(): JsonResponse
    {
        $Categories = QueryBuilder::for(
            subject: Category::class,
        )->allowedIncludes(
            includes: ['user']
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
