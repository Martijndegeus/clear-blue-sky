<?php

namespace App\Http\Controllers;

use App\Connectors\Amadeus\AmadeusConnector;
use App\Connectors\Amadeus\OfferSearch;
use App\Http\Requests\RoundtripRequest;
use App\Http\Resources\AirportResource;
use App\Http\Resources\FlightOfferResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class FlightDataController extends Controller
{
    /**
     * Search offers
     *
     * @param RoundtripRequest $request
     * @return JsonResponse|AnonymousResourceCollection
     */
    public function offerSearch(RoundtripRequest $request)
    {
        $body = OfferSearch::generateBody($request->all());

        $amadeus = new AmadeusConnector();
        $response = $amadeus->post('v2/shopping/flight-offers', $body);

        if (isset($response->data)) {
            return FlightOfferResource::collection(collect($response->data));
        } else {
            return response()->json(['message' => 'No offers found'], 404);
        }
    }

    /**
     * Search airports by city
     *
     * @param String $query
     * @return AnonymousResourceCollection
     */
    public function airportSearch(String $query): AnonymousResourceCollection
    {
        $amadeus = new AmadeusConnector();

        $response = $amadeus->get('v1/reference-data/locations?subType=AIRPORT&keyword=' . $query);

        return AirportResource::collection($response->data);
    }
}
