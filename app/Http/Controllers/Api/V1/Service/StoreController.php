<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1\Service;

use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Domain\Service\Jobs\CreateService;
use Domain\Service\Factory\ServiceFactory;
use App\Http\Requests\Api\V1\Service\StoreRequest;

class StoreController extends Controller
{
    public function __invoke(StoreRequest $request): Response
    {
        $fact = ServiceFactory::create(attributes: $request->validated());
        dd($fact);
        CreateService::dispatch(
            object: ServiceFactory::create(attributes: $request->validated())
        );
       
        return response(
            content: null,
            status: 202
        );
    }
}
