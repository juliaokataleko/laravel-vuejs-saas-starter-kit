<?php

use App\Http\Controllers\Api\V1\BusinessController;
use App\Http\Controllers\Api\V1\LocationController;
use App\Http\Controllers\Api\V1\PlanController;
use App\Http\Controllers\Api\V1\SubscriptionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('v1')->name('api.')->group(function () {
    Route::get('country/{country}/states', [LocationController::class, 'states'])->name('countryStates');
    Route::get('state/{state}/cities', [LocationController::class, 'cities'])->name('stateCities');

    Route::apiResource('businesses', BusinessController::class);
    Route::apiResource('plans', PlanController::class);
    Route::apiResource('subscriptions', SubscriptionController::class);
});
