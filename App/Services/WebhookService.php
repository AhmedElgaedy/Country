<?php

namespace App\Services;

use App\Jobs\CallWebhook;
use App\Models\Webhook;
use App\Repositories\WebhookRepository;
use Illuminate\Support\Facades\Http;

class WebhookService
{
    protected $webhookRepository;

    public function __construct(WebhookRepository $webhookRepository)
    {
        $this->webhookRepository = $webhookRepository;
    }

    public function notifyAllWebhooks($country)
    {
        $webhooks = $this->webhookRepository->all();

        foreach ($webhooks as $webhook) {
            CallWebhook::dispatch($webhook, $country);
        }
    }

    public function createWebhook(array $data): Webhook
    {
        return $this->webhookRepository->create($data);
    }

    public function triggerWebhook($id, $action, $oldData = [], $newData = [])
    {
        $webhook = Webhook::find($id);

        if ($webhook) {
            $payload = [
                'action' => $action,
                'old_data' => $oldData,
                'new_data' => $newData,
            ];

            Http::post($webhook->callback_url, $payload);
        }
    }
}
