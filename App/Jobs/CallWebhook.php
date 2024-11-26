<?php

namespace App\Jobs;


use App\Models\Webhook;
use App\Services\WebhookService;
use Illuminate\Contracts\Queue\ShouldQueue;

class CallWebhook implements ShouldQueue
{
    protected $webhook;
    protected $data;

    public function __construct(Webhook $webhook, array $data)
    {
        $this->webhook = $webhook;
        $this->data = $data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(WebhookService $webhookService)
    {
        $webhookService->triggerWebhook(
            $this->webhook->id,
            'update',
            $this->data['old_data'],
            $this->data['new_data']
        );
    }
}
