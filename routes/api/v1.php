<?php

declare(strict_types=1);

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\V1\Category\ShowController;
use App\Http\Controllers\Api\V1\Category\IndexController;
use App\Http\Controllers\Api\V1\Category\StoreController;
use App\Http\Controllers\Api\V1\Category\DeleteController;
use App\Http\Controllers\Api\V1\Category\UpdateController;

use App\Http\Controllers\Api\V1\User\ShowController as UserShow;
use App\Http\Controllers\Api\V1\User\IndexController as UserIndex;
use App\Http\Controllers\Api\V1\User\StoreController as UserStore;

use App\Http\Controllers\Api\V1\User\DeleteController as UserDelete;
use App\Http\Controllers\Api\V1\User\UpdateController as UserUpadate;
use App\Http\Controllers\Api\V1\Service\ShowController as ServiceShow;
use App\Http\Controllers\Api\V1\Service\IndexController as ServiceIndex;
use App\Http\Controllers\Api\V1\Service\StoreController as ServiceStore;
use App\Http\Controllers\Api\V1\Service\DeleteController as ServiceDelete;
use App\Http\Controllers\Api\V1\Service\UpdateController as ServiceUpadate;


use App\Http\Controllers\Auth\Api\LoginController;
use App\Http\Controllers\Auth\Api\LogoutController;
use App\Http\Controllers\Auth\Api\RegisterController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('auth')->as('auth')->group(function(){
    Route::post('login', LoginController::class)->name('login');
    Route::post('logout', LogoutController::class)->name('logout');
    Route::post('register', RegisterController::class)->name('register');
});

Route::middleware('auth:sanctum')->prefix('user')->as('user')->group(function(){
    Route::get('/', UserIndex::class)->name('index'); //route('api:v1:user:index');
    Route::post('/', UserStore::class)->name('store'); //route('api:v1:user:store');
    Route::get('{user:key}', UserShow::class)->name('show'); //route('api:v1:user:show');
    Route::patch('{user:key}', UserUpadate::class)->name('update'); //route('api:v1:user:update');
    Route::delete('{user:key}', UserDelete::class)->name('delete'); //route('api:v1:user:delete');
});

Route::middleware('auth:sanctum')->prefix('category')->as('category')->group(function(){
    Route::get('/', IndexController::class)->name('index'); //route('api:v1:category:index');
    Route::post('/', StoreController::class)->name('store'); //route('api:v1:category:store');
    Route::get('{category:key}', ShowController::class)->name('show'); //route('api:v1:category:show');
    Route::patch('{category:key}', UpdateController::class)->name('update'); //route('api:v1:category:update');
    Route::delete('{category:key}', DeleteController::class)->name('delete'); //route('api:v1:category:delete');
});

Route::middleware('auth:sanctum')->prefix('service')->as('service')->group(function(){
    Route::get('/', ServiceIndex::class)->name('index'); //route('api:v1:service:index');
    Route::post('/', ServiceStore::class)->name('store'); //route('api:v1:service:store');
    Route::get('{service:key}', ServiceShow::class)->name('show'); //route('api:v1:service:show');
    Route::patch('{service:key}', ServiceUpadate::class)->name('update'); //route('api:v1:service:update');
    Route::delete('{service:key}', ServiceDelete::class)->name('delete'); //route('api:v1:service:delete');
});
