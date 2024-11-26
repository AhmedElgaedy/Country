<?php

namespace App\Listeners;


use App\Events\CountryUpdated;
use App\Services\WebhookService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class NotifyWebhooks implements ShouldQueue
{
    use InteractsWithQueue;

    protected $webhookService;

    public function __construct(WebhookService $webhookService)
    {
        $this->webhookService = $webhookService;
    }

    /**
     *
     * @param  \App\Events\CountryUpdated  $event
     */
    public function handle(CountryUpdated $event)
    {
        $country = $event->country;
        $this->webhookService->triggerWebhook(
            $country->id,
            'update',
            $event->country->getOriginal(),
            $country->getAttributes()
        );
    }
}
