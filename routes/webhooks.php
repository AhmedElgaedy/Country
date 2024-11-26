<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\WebhookController;

Route::post('/webhooks/receive', [WebhookController::class, 'receiveWebhook']);

Route::get('/webhooks/logs', [WebhookController::class, 'viewLogs']);
