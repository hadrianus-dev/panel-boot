<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1\Service;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Domain\Service\Models\Service;
use App\Http\Controllers\Controller;
use Domain\Service\Jobs\DeleteService;

class DeleteController extends Controller
{

    public function __invoke(Request $request, Service $Service): Response
    {
         //chu_AWE7tw9jUXTb
         DeleteService::dispatch($Service);

         return response(
             content: null,
             status: 202
         );
    }
}
