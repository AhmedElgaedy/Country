<?php

namespace App\Http\Controllers;

use App\Http\Requests\WebhookRequest;
use App\Http\Resources\WebhookResource;
use App\Services\WebhookService;
use App\Models\Webhook;
use Illuminate\Http\Request;

class WebhookController extends Controller
{
    protected $webhookService;

    public function __construct(WebhookService $webhookService)
    {
        $this->webhookService = $webhookService;
    }

    /**
     * Display a listing of the webhooks.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $webhooks = Webhook::all();
        return WebhookResource::collection($webhooks);
    }

    /**
     * Store a newly created webhook in storage.
     *
     * @param  \App\Http\Requests\WebhookRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(WebhookRequest $request)
    {
        $webhook = $this->webhookService->createWebhook($request->validated());
        return new WebhookResource($webhook);
    }

    /**
     * Trigger the webhooks with the update data.
     *
     * @param  int  $id
     * @param  string  $action
     * @param  array  $oldData
     * @param  array  $newData
     * @return \Illuminate\Http\Response
     */
    public function triggerWebhook($id, $action, $oldData = [], $newData = [])
    {
        $this->webhookService->triggerWebhook($id, $action, $oldData, $newData);
        return response()->json(['message' => 'Webhook triggered successfully.']);
    }
}
