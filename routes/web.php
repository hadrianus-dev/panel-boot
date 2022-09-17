<?php

use App\Http\Livewire\Panel\Auth\LoginController;
use App\Http\Livewire\Panel\Auth\RegisterController;
use App\Http\Livewire\Panel\Dashboard\DashboardController;
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


Route::get('/', LoginController::class)->name('login');

Route::prefix('auth')->as('auth')->group(function(){
    Route::get('/dashboard', DashboardController::class)->name('dashboard');
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