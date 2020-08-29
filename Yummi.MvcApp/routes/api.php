<?php

use App\Http\Controllers\AddOrUpdateDrinkUseCase\AddOrUpdateDrinkController;
use App\Http\Controllers\AddOrUpdatePizzaUseCase\AddOrUpdatePizzaController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/



Route::middleware('api')->group(function(){
    Route::prefix('auth')->group(function (){
        Route::post('login', 'AuthController@login');
        Route::post('register', 'AuthController@register');
        Route::post('logout', 'AuthController@logout');
        Route::post('refresh', 'AuthController@refresh');
        Route::post('user', 'AuthController@user');
    });

    //Pizzas
    Route::put('/addOrUpdate/pizza', [AddOrUpdatePizzaController::class, "Execute"]);
    Route::get('/pizzas', [GetPizzasController::class, 'Execute']);

    //Drinks
    Route::put('/addOrUpdate/drink', [AddOrUpdateDrinkController::class, "Execute"]);
});
