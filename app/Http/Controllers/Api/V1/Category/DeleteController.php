<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1\Category;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Domain\Category\Models\Category;
use App\Http\Controllers\Controller;
use Domain\Category\Jobs\DeleteCategory;

class DeleteController extends Controller
{

    public function __invoke(Request $request, Category $Category): Response
    {
         //chu_AWE7tw9jUXTb
         DeleteCategory::dispatch($Category);

         return response(
             content: null,
             status: 202
         );
    }
}
