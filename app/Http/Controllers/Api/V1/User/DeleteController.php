<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1\User;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Domain\Shared\Models\User;
use App\Http\Controllers\Controller;
use Domain\Shared\User\Jobs\DeleteUser;

class DeleteController extends Controller
{

    public function __invoke(Request $request, User $user): Response
    {
         //chu_AWE7tw9jUXTb
         DeleteUser::dispatch($user);

         return response(
             content: null,
             status: 202
         );
    }
}
