<?php

use App\Http\Livewire\Panel\Auth\LoginController;
use App\Http\Livewire\Panel\Auth\RegisterController;
use App\Http\Livewire\Panel\Category\IndexController;
use App\Http\Livewire\Panel\Category\StoreController;
use App\Http\Livewire\Panel\Category\UpdateController;
use App\Http\Livewire\Panel\Dashboard\DashboardController;
use App\Http\Livewire\Panel\Post\IndexController as PostIndexController;
use App\Http\Livewire\Panel\Post\StoreController as PostStoreController;
use App\Http\Livewire\Panel\Post\UpdateController as PostUpdateController;
use App\Http\Livewire\Panel\Service\IndexController as ServiceIndexController;
use App\Http\Livewire\Panel\Service\StoreController as ServiceStoreController;
use App\Http\Livewire\Panel\Service\UpdateController as ServiceUpdateController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/login', LoginController::class)->name('login');

Route::middleware('auth')->group(function(){
    Route::get('/', DashboardController::class)->name('dashboard');
    /* Route::post('logout', LogoutController::class)->name('logout'); */
    Route::post('register', RegisterController::class)->name('register');
});
/* 
Route::middleware('auth:sanctum')->prefix('user')->as('user')->group(function(){
    Route::get('/', UserIndex::class)->name('index'); //route('api:v1:user:index');
    Route::post('/', UserStore::class)->name('store'); //route('api:v1:user:store');
    Route::get('{user:key}', UserShow::class)->name('show'); //route('api:v1:user:show');
    Route::patch('{user:key}', UserUpadate::class)->name('update'); //route('api:v1:user:update');
    Route::delete('{user:key}', UserDelete::class)->name('delete'); //route('api:v1:user:delete');
});
 */

 
Route::middleware('auth:sanctum')->prefix('category')->as('category')->group(function(){
    Route::get('/', IndexController::class)->name('index'); //route('api:v1:category:index');
    Route::get('/store', StoreController::class)->name('store'); //route('api:v1:category:store');
    Route::get('{category:key}', UpdateController::class)->name('update'); //route('api:v1:category:store');
    /* Route::get('{category:key}', ShowController::class)->name('show'); //route('api:v1:category:show');
    Route::patch('{category:key}'1, UpdateController::class)->name('update'); //route('api:v1:category:update');
    Route::delete('{category:key}', DeleteController::class)->name('delete'); //route('api:v1:category:delete'); */
});
 
Route::middleware('auth:sanctum')->prefix('service')->as('service')->group(function(){
    Route::get('/', ServiceIndexController::class)->name('index'); //route('api:v1:category:index');
    Route::get('/store', ServiceStoreController::class)->name('store'); //route('api:v1:category:store');
    Route::get('{service:key}', ServiceUpdateController::class)->name('update'); //route('api:v1:category:store');
    /* Route::get('{category:key}', ShowController::class)->name('show'); //route('api:v1:category:show');
    Route::patch('{category:key}'1, UpdateController::class)->name('update'); //route('api:v1:category:update');
    Route::delete('{category:key}', DeleteController::class)->name('delete'); //route('api:v1:category:delete'); */
});
 
Route::middleware('auth:sanctum')->prefix('post')->as('post')->group(function(){
    Route::get('/', PostIndexController::class)->name('index'); //route('api:v1:category:index');
    Route::get('/store', PostStoreController::class)->name('store'); //route('api:v1:category:store');
    Route::get('{post:key}', PostUpdateController::class)->name('update'); //route('api:v1:category:store');
    /* Route::get('{category:key}', ShowController::class)->name('show'); //route('api:v1:category:show');
    Route::patch('{category:key}'1, UpdateController::class)->name('update'); //route('api:v1:category:update');
    Route::delete('{category:key}', DeleteController::class)->name('delete'); //route('api:v1:category:delete'); */
});
