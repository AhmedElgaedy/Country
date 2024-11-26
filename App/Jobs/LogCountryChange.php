<?php

namespace App\Jobs;

use App\Models\Country;
use Illuminate\Support\Facades\Log;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;




class LogCountryChange implements ShouldQueue
{
    protected $country;

    public function __construct(Country $country)
    {
        $this->country = $country;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Log::info('Country Change Logged: ', $this->country->toArray());
    }
}
