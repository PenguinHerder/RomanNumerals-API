<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RomanNumber extends JsonResource
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
            'decimal' => $this->id,
            'roman' => $this->roman,
            'request_count' => $this->request_count,
            'first_requested' => $this->created_at->toDateTimeString(),
            'last_requested' => $this->updated_at->toDateTimeString(),
        ];
    }
}
