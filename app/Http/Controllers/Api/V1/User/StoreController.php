<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1\User;

use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Domain\Shared\User\Jobs\CreateUser;
use Domain\Shared\User\Factory\UserFactory;
use App\Http\Requests\Api\V1\User\StoreRequest;

class StoreController extends Controller
{
    public function __invoke(StoreRequest $request): Response
    {
       /*  $fact = UserFactory::create(attributes: $request->validated());
        dd($fact) */
        CreateUser::dispatch(
            object: UserFactory::create(attributes: $request->validated())
        );
       
        return response(
            content: null,
            status: 202
        );
    }
}
