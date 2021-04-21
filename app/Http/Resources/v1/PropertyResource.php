<?php

namespace App\Http\Resources\v1;

use Illuminate\Http\Resources\Json\JsonResource;

class PropertyResource extends JsonResource
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
            'id' => $this->when(!is_null($this->id), $this->id),
            'name' => $this->when(!is_null($this->name), $this->name),
            'slug' => $this->when(!is_null($this->slug), $this->slug),
            'created_at' => $this->when(!is_null($this->created_at), $this->created_at),
            'updated_at' => $this->when(!is_null($this->updated_at), $this->updated_at),
            'address' => PropertyAddressResource::make($this->whenLoaded('address')),
            'images' => MediaFileResource::collection($this->whenLoaded('images'))
        ];
    }
}
