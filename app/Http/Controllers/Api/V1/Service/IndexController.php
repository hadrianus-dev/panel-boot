<?php

namespace App\Http\Controllers\Api\V1\Service;


use Illuminate\Http\Request;

use Domain\Service\Models\Service;
use Illuminate\Http\JsonResponse;
use JustSteveKing\StatusCode\Http;
use App\Http\Controllers\Controller;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;
use App\Http\Resources\Api\V1\Service\ServiceResource;

class IndexController extends Controller
{
    public function __invoke(Request $request): JsonResponse
    {
        $Services = QueryBuilder::for(
            subject: Service::class,
        )->allowedIncludes(
            includes: ['category']
        )->allowedFilters(
            [
                AllowedFilter::scope('published'),
                AllowedFilter::scope('draft'),
            ]
        )->get();

        return response()->json(
            data: ServiceResource::collection(
                resource: $Services,
            ),
            status: 200
        );
    }
}
