<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\SoapController;
use App\Http\Controllers\Api\WebhookController;

Route::middleware('auth:api')->group(function () {
    Route::get('/soap/countries', [SoapController::class, 'getCountries']);

    Route::post('/soap/callback', [SoapController::class, 'receiveCallback']);
});

Route::post('/soap/webhook/{id}/{action}', [SoapController::class, 'triggerWebhook']);
