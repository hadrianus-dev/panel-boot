<?php

namespace App\Http\Controllers\Api\V1\Service;

use Illuminate\Http\Request;
use Domain\Service\Models\Service;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\V1\Service\ServiceResource;
use Spatie\QueryBuilder\QueryBuilder;

class ShowController extends Controller
{
    public function __invoke(Request $request, Service $Service)
    {
        $_Service = QueryBuilder::for(
            subject: $Service
        )->allowedIncludes(
            includes: ['category']
        )->first();

        return response()->json(
            data: new ServiceResource(
                resource: $_Service,
            ),
            status: 200
        );
    }
}
