<?php

namespace App\Http\Resources;

use App\Models\Reference;
use Carbon\Carbon;
use DateInterval;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FlightOfferResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request)
    {
        $itineraries = [];
        $resource = $this->resource;

        foreach ($resource->itineraries as $itinerary) {
            $segments = [];

            foreach ($itinerary->segments as $segment) {
                $segmentDuration = new DateInterval($segment->duration);
                $segmentDurationString = $segmentDuration->format("%Hh%Im");

                $segments[] = [
                    'departure' => [
                        'airport' => Reference::getLocation($segment->departure->iataCode),
                        'time'    => Carbon::parse($segment->departure->at)->format('H:i d-m'),
                    ],

                    'arrival'  => [
                        'airport' => Reference::getLocation($segment->arrival->iataCode),
                        'time'    => Carbon::parse($segment->arrival->at)->format('H:i d-m'),
                    ],
                    'duration' => $segmentDurationString,
                    'carrier'  =>
                        [
                            $segment->carrierCode => ucwords(strtolower(Reference::getCarrier($segment->carrierCode))),
                        ],
                    'operator' => isset($segment->operating) ? Reference::getCarrier($segment->operating->carrierCode) : Reference::getCarrier($segment->carrierCode),
                    'aircraft' => Reference::getAircraftName($segment->aircraft->code),
                ];
            }

            $duration = new DateInterval($itinerary->duration);
            $durationString = $duration->format("%Hh%Im");

            $itineraries[] = [
                'duration' => $durationString,
                'segments' => $segments,
            ];
        }

        return [
            'available_seats' => $resource->numberOfBookableSeats,
            'itineraries'     => $itineraries,
            'price'           => [
                'currency' => Reference::getCurrency($resource->price->currency),
                'total'    => number_format($resource->price->grandTotal, 2, ',', '.'),
            ],
        ];
    }
}
