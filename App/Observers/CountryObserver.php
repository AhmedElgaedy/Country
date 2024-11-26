<?php

namespace App\Observers;

use App\Models\Country;
use App\Events\CountryUpdated;
use Illuminate\Support\Facades\Log;

class CountryObserver
{
    /**
     *
     * @param  \App\Models\Country  $country
     */
    public function created(Country $country)
    {
        Log::info('Country created: ' . $country->name);
    }

    /**
     *
     * @param  \App\Models\Country  $country
     */
    public function updated(Country $country)
    {
        event(new CountryUpdated($country));

        Log::info('Country updated: ' . $country->name);
    }

    /**
     *
     * @param  \App\Models\Country  $country
     */
    public function deleted(Country $country)
    {
        Log::info('Country deleted: ' . $country->name);
    }
}
