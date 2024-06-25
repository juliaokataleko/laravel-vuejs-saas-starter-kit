<?php

use App\Http\Controllers\Api\V1\LocationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('country/{country}/states', [LocationController::class, 'states'])->name('countryStates');
Route::get('state/{state}/cities', [LocationController::class, 'cities'])->name('stateCities');
