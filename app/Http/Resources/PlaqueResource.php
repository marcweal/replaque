<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PlaqueResource extends JsonResource
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
            'name' => $this->name,
            'address_line_1' => $this->address_line_1,
            'address_line_2' => $this->address_line_2,
            'address_line_3' => $this->address_line_3,
            'city' => $this->city,
            'postcode' => $this->postcode,
            'lat' => $this->lat,
            'lng' => $this->lng,
            'unveiler' => $this->unveiler,
            'date_unveiled' => $this->date_unveiled,
            'sponsor' => $this->sponsor,
            'comments' => $this->comments,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            // TODO: Complete rest of fields.
            // https://laravel.com/docs/5.8/eloquent-resources#writing-resources
            // TODO: Return dates/datetimes as ISO8601.
            // https://carbon.nesbot.com/docs/#api-commonformats
        ];
    }
}
