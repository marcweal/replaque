<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TicketResource extends JsonResource
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
            'id' => $this->id,
            'plaque_id' => $this->plaque_id,
            'name' => $this->name,
            'description' => $this->description,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'closed_at' => $this->closed_at,
            // TODO: Complete rest of fields.
            // https://laravel.com/docs/5.8/eloquent-resources#writing-resources
            // TODO: Return dates/datetimes as ISO8601.
            // https://carbon.nesbot.com/docs/#api-commonformats
        ];
    }
}
