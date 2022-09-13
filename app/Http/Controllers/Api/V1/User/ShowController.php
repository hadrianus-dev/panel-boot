<?php

namespace App\Http\Controllers\Api\V1\User;

use Illuminate\Http\Request;
use Domain\Shared\Models\User;
use App\Http\Controllers\Controller;
use Spatie\QueryBuilder\QueryBuilder;
use App\Http\Resources\Api\Tronus\User\UserResource;

class ShowController extends Controller
{
    public function __invoke(Request $request, User $church)
    {
        $_church = QueryBuilder::for(
            subject: $church
        )->allowedIncludes(
            includes: ['user']
        )->first();

        return response()->json(
            data: new UserResource(
                resource: $_church,
            ),
            status: 200
        );
    }
}
