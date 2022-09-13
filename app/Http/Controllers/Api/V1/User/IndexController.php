<?php

namespace App\Http\Controllers\Api\V1\User;


use Illuminate\Http\Request;

use Illuminate\Http\JsonResponse;
use JustSteveKing\StatusCode\Http;
use App\Http\Controllers\Controller;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;
use App\Http\Resources\Api\Tronus\User\UserResource;
use Domain\Shared\Models\User;

class IndexController extends Controller
{
    public function __invoke(Request $request): JsonResponse
    {
        $Users = QueryBuilder::for(
            subject: User::class,
        )->allowedFilters(
            [
                AllowedFilter::scope('published'),
                AllowedFilter::scope('draft'),
            ]
        )->get();

        return response()->json(
            data: UserResource::collection(
                resource: $Users,
            ),
            status: 200
        );
    }
}
