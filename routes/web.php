<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\WebhookController;

Route::post('/webhook/trigger', [WebhookController::class, 'triggerWebhook']);
