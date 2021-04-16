<?php

namespace App\Http\Resources\v1;

use Illuminate\Http\Resources\Json\JsonResource;

class EmploymentResource extends JsonResource
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
            'job_title' => $this->job_title,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
        ];
    }
}
