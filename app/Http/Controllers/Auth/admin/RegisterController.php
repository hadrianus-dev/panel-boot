<?php

namespace App\Http\Controllers\Auth\Api;

use Illuminate\Http\Response;
use Domain\Shared\Models\User;
use App\Http\Controllers\Controller;
use Domain\Shared\User\Jobs\CreateUser;
use Domain\Shared\User\Factory\UserFactory;
use App\Http\Requests\Api\V1\User\StoreRequest;

class RegisterController extends Controller
{
    public function __invoke(StoreRequest $request): Response
    {

        CreateUser::dispatch(
            object: UserFactory::create(attributes: $request->validated())
        );

        $user = User::where('email', $request->email)->first();

        return response(
            content: [
                'token' => $user->createToken("API_TOKEN")->plainTextToken
            ],
            status: 202
        );

    }
}
