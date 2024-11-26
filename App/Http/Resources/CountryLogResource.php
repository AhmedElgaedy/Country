<?php

namespace App\Http\Resources;


use Illuminate\Http\Resources\Json\JsonResource;




class CountryLogResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'country_id' => $this->country_id,
            'action' => $this->action,
            'old_data' => $this->old_data,
            'new_data' => $this->new_data,
            'created_at' => $this->created_at,
        ];
    }
}
