<?php

namespace App\Providers;

use App\Events\CountryUpdated;
use App\Listeners\NotifyWebhooks;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     *
     * @var array
     */
    protected $listen = [
        CountryUpdated::class => [
            NotifyWebhooks::class,
        ],
    ];

    /**
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
    }
}
