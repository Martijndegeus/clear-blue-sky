<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AirportResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request)
    {
        $resource = $this->resource;

        return [
            'city'     => ucwords(strtolower($resource->address->cityName)),
            'country'  => ucwords(strtolower($resource->address->countryName)),
            'name'     => ucwords(strtolower($resource->name)),
            'iataCode' => $resource->iataCode,
        ];
    }
}
