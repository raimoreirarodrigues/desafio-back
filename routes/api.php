<?php

use App\Http\Controllers\CityController;
use App\Http\Controllers\ClientController;
use Illuminate\Support\Facades\Route;


$VERSION_API = env('APP_VERSION_API', 'v1');

 Route::middleware(['redirectnojson'])->prefix($VERSION_API)->group(function(){

    //Cidades
    Route::controller(CityController::class)->group(function (){
        Route::prefix('city')->group(function(){
           Route::get('/{uf}','list')->name('city')->middleware(['throttle:100,1','xss.sanitizer']);
        });
    });

     //Clientes
     Route::controller(ClientController::class)->group(function (){
        Route::prefix('client')->group(function(){
           Route::get('','list')->name('client')->middleware(['throttle:100,1','xss.sanitizer']);
           Route::post('','store')->name('client')->middleware(['throttle:10,1','xss.sanitizer']);
           Route::get('/{id}','edit')->middleware(['throttle:100,1','xss.sanitizer']);
        });
    });
 });