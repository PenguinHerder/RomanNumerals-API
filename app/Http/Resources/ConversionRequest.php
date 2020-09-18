<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ConversionRequest extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        if ($this->whenLoaded('romanNumber')) {
            return [
                'decimal' => $this->romanNumber->id,
                'roman' => $this->romanNumber->roman,
                'request_count' => $this->romanNumber->request_count,
                'requested_at' => $this->request_date->toDateTimeString(),
                'first_requested' => $this->romanNumber->created_at->toDateTimeString(),
                'last_requested' => $this->romanNumber->updated_at->toDateTimeString(),
            ];
        }
    }
}
