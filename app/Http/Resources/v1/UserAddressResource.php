<?php

namespace App\Http\Resources\v1;

use Illuminate\Http\Resources\Json\JsonResource;

class UserAddressResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'postcode' => $this->postcode,
            'address_line' => $this->address_line,
            'city' => CityResource::make($this->whenLoaded('city')),
        ];
    }
}
