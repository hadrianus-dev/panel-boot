<?php

namespace App\Http\Controllers\Auth\Api;

use Illuminate\Http\Request;
use Domain\Shared\Models\User;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LogoutController extends Controller
{
    public function __invoke(Request $request): JsonResponse
    {
        #dd(Auth::check());
        $user = User::where('email', Auth::user()->email)->first();
        $user->currentAccessToken()->delete();
            
        return response()->json([
            'status' => true,
            'message' => 'Logout successfully'
        ], 200);

    }
}
