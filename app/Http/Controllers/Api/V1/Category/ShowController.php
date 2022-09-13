<?php

namespace App\Http\Controllers\Api\V1\Category;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Domain\Category\Models\Category;
use Spatie\QueryBuilder\QueryBuilder;
use App\Http\Resources\Api\V1\Category\CategoryResource;

class ShowController extends Controller
{
    public function __invoke(Request $request, Category $Category)
    {
        $_Category = QueryBuilder::for(
            subject: $Category
        )->first();

        return response()->json(
            data: new CategoryResource(
                resource: $_Category,
            ),
            status: 200
        );
    }
}
