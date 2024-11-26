<?php

namespace App\Events;


use App\Models\Country;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class CountryUpdated
{
    use Dispatchable, SerializesModels;

    public $country;

    /**
     *
     * @param  \App\Models\Country  $country
     */
    public function __construct(Country $country)
    {
        $this->country = $country;
    }
}
