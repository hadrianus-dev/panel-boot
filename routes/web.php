<?php

use App\Http\Livewire\Panel\Aparence\IndexController as AparenceIndexController;
use App\Http\Livewire\Panel\Aparence\StoreController as AparenceStoreController;
use App\Http\Livewire\Panel\Aparence\UpdateController as AparenceUpdateController;
use App\Http\Livewire\Panel\Auth\LoginController;
use App\Http\Livewire\Panel\Auth\RegisterController;
use App\Http\Livewire\Panel\Category\IndexController;
use App\Http\Livewire\Panel\Category\StoreController;
use App\Http\Livewire\Panel\Category\UpdateController;
use App\Http\Livewire\Panel\Dashboard\DashboardController;
use App\Http\Livewire\Panel\Enterprise\IndexController as EnterpriseIndexController;
use App\Http\Livewire\Panel\Enterprise\PartnerController;
use App\Http\Livewire\Panel\Enterprise\StoreController as EnterpriseStoreController;
use App\Http\Livewire\Panel\Enterprise\UpdateController as EnterpriseUpdateController;
use App\Http\Livewire\Panel\FAQ\IndexController as FAQIndexController;
use App\Http\Livewire\Panel\FAQ\StoreController as FAQStoreController;
use App\Http\Livewire\Panel\FAQ\UpdateController as FAQUpdateController;
use App\Http\Livewire\Panel\Portfolio\IndexController as PortfolioIndexController;
use App\Http\Livewire\Panel\Portfolio\StoreController as PortfolioStoreController;
use App\Http\Livewire\Panel\Portfolio\UpdateController as PortfolioUpdateController;
use App\Http\Livewire\Panel\Post\IndexController as PostIndexController;
use App\Http\Livewire\Panel\Post\StoreController as PostStoreController;
use App\Http\Livewire\Panel\Post\UpdateController as PostUpdateController;
use App\Http\Livewire\Panel\Service\IndexController as ServiceIndexController;
use App\Http\Livewire\Panel\Service\StoreController as ServiceStoreController;
use App\Http\Livewire\Panel\Service\UpdateController as ServiceUpdateController;
use App\Http\Livewire\Panel\Team\IndexController as TeamIndexController;
use App\Http\Livewire\Panel\Team\StoreController as TeamStoreController;
use App\Http\Livewire\Panel\Team\UpdateController as TeamUpdateController;
use App\Http\Livewire\Panel\User\IndexController as UserIndexController;
use App\Http\Livewire\Panel\User\StoreController as UserStoreController;
use App\Http\Livewire\Panel\User\UpdateController as UserUpdateController;
use Illuminate\Support\Facades\Route;


Route::get('/login', LoginController::class)->name('login');

Route::middleware('auth')->group(function(){
    Route::get('/', DashboardController::class)->name('dashboard');
    /* Route::post('logout', LogoutController::class)->name('logout'); */
    Route::post('register', RegisterController::class)->name('register');
});

Route::middleware('auth:sanctum')->prefix('user')->as('user')->group(function(){
    Route::get('/', UserIndexController::class)->name('index'); 
    Route::get('/store', UserStoreController::class)->name('store'); 
    Route::get('{user:key}', UserUpdateController::class)->name('update'); 
/*  Route::get('{user:key}', UserShow::class)->name('show');  */
});

Route::middleware('auth:sanctum')->prefix('category')->as('category')->group(function(){
    Route::get('/', IndexController::class)->name('index'); 
    Route::get('/store', StoreController::class)->name('store'); 
    Route::get('{category:key}', UpdateController::class)->name('update'); 
});
 
Route::middleware('auth:sanctum')->prefix('service')->as('service')->group(function(){
    Route::get('/', ServiceIndexController::class)->name('index'); 
    Route::get('/store', ServiceStoreController::class)->name('store'); 
    Route::get('{service:key}', ServiceUpdateController::class)->name('update'); 
});
 
Route::middleware('auth:sanctum')->prefix('post')->as('post')->group(function(){
    Route::get('/', PostIndexController::class)->name('index'); 
    Route::get('/store', PostStoreController::class)->name('store'); 
    Route::get('{post:key}', PostUpdateController::class)->name('update'); 
});
 
Route::middleware('auth:sanctum')->prefix('portfolio')->as('portfolio')->group(function(){
    Route::get('/', PortfolioIndexController::class)->name('index'); 
    Route::get('/store', PortfolioStoreController::class)->name('store'); 
    Route::get('{portfolio:key}', PortfolioUpdateController::class)->name('update'); 
});
 
Route::middleware('auth:sanctum')->prefix('enterprise')->as('enterprise')->group(function(){
    Route::get('/', EnterpriseIndexController::class)->name('index'); 
    Route::get('/store', EnterpriseStoreController::class)->name('store'); 
    Route::get('{enterprise:key}', EnterpriseUpdateController::class)->name('update'); 
});
 
Route::middleware('auth:sanctum')->prefix('partner')->as('partner')->group(function(){
    Route::get('/', PartnerController::class)->name('index'); 
});

Route::middleware('auth:sanctum')->prefix('team')->as('team')->group(function(){
    Route::get('/', TeamIndexController::class)->name('index'); 
    Route::get('/store', TeamStoreController::class)->name('store'); 
    Route::get('{team:key}', TeamUpdateController::class)->name('update'); 
});

Route::middleware('auth:sanctum')->prefix('aparence')->as('aparence')->group(function(){
    Route::get('/', AparenceIndexController::class)->name('index'); 
    Route::get('/store', AparenceStoreController::class)->name('store'); 
    Route::get('{aparence:key}', AparenceUpdateController::class)->name('update'); 
});

Route::middleware('auth:sanctum')->prefix('faq')->as('faq')->group(function(){
    Route::get('/', FAQIndexController::class)->name('index'); 
    Route::get('/store', FAQStoreController::class)->name('store'); 
    Route::get('{faq:key}', FAQUpdateController::class)->name('update'); 
});
