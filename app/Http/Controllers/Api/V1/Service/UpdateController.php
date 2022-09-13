<?php

namespace App\Http\Controllers\Api\V1\Service;

use Illuminate\Http\Response;
use Domain\Service\Models\Service;
use App\Http\Controllers\Controller;
use Domain\Service\Jobs\UpdateService;
use Domain\Service\Factory\ServiceFactory;
use App\Http\Requests\Api\V1\Service\UpdateRequest;

class UpdateController extends Controller
{
    public function __invoke(UpdateRequest $updateRequest, Service $Service): Response
    {
        UpdateService::dispatch(
            Service: $Service,
            object: ServiceFactory::create(attributes: $updateRequest->validated())
        );

        $Service->fresh();

        return response(
            content: null, status: 200
        );
    }
}
