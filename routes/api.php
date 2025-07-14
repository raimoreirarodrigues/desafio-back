<?php

use App\Http\Controllers\AgentController;
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
           Route::post('','store')->name('client')->middleware(['throttle:100,1','xss.sanitizer']);
           Route::get('/{id}','edit')->middleware(['throttle:100,1','xss.sanitizer']);
           Route::put('/{id}','update')->middleware(['throttle:100,1','xss.sanitizer']);
           Route::delete('/{id}','delete')->middleware(['throttle:10,1','xss.sanitizer']);
        });
    });

    //Representantes
     Route::controller(AgentController::class)->group(function (){
        Route::prefix('agent')->group(function(){
           Route::get('','list')->name('agent')->middleware(['throttle:100,1','xss.sanitizer']);
           Route::post('','store')->name('agent')->middleware(['throttle:100,1','xss.sanitizer']);
           Route::get('/{id}','edit')->middleware(['throttle:100,1','xss.sanitizer']);
           Route::put('/{id}','update')->middleware(['throttle:100,1','xss.sanitizer']);
           Route::delete('/{id}','delete')->middleware(['throttle:10,1','xss.sanitizer']);
           Route::get('/{id}/cities','citiesAgent')->middleware(['throttle:100,1','xss.sanitizer']);
           Route::post('/{id}/cities','storeCityAgent')->middleware(['throttle:100,1','xss.sanitizer']);
           Route::delete('/{id}/cities','deleteCityAgent')->middleware(['throttle:100,1','xss.sanitizer']);
        });
    });
 });