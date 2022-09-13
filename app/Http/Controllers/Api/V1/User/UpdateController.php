<?php

namespace App\Http\Controllers\Api\V1\User;

use Illuminate\Http\Response;
use Domain\Shared\Models\User;
use App\Http\Controllers\Controller;
use Domain\Shared\User\Jobs\UpdateUser;
use Domain\Shared\User\Factory\UserFactory;
use App\Http\Requests\Api\V1\User\UpdateRequest;

class UpdateController extends Controller
{
    public function __invoke(UpdateRequest $updateRequest, User $user): Response
    {
        UpdateUser::dispatch(
            user: $user,
            object: UserFactory::create(attributes: $updateRequest->validated())
        );

        $user->fresh();

        return response(
            content: null, status: 200
        );
    }
}
