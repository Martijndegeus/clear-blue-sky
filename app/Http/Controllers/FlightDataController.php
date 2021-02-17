<?php

namespace App\Http\Controllers;

use App\Connectors\Amadeus\AmadeusConnector;
use App\Http\Requests\RoundtripRequest;
use App\Http\Resources\FlightOfferResource;
use Carbon\Carbon;

class FlightDataController extends Controller
{
    public function search(RoundtripRequest $request)
    {
        $data = $request->all();

        $body = [
            'currencyCode'       => 'EUR',
            'travelers'          => [
                [
                    'id'           => $data['number_of_adults'],
                    'travelerType' => 'ADULT',
                ],

            ],
            'sources'            => [
                'GDS',
            ],
            'originDestinations' => [
                [
                    'id'                      => '1',
                    'originLocationCode'      => $data['origin'],
                    'destinationLocationCode' => $data['destination'],
                    'departureDateTimeRange'  => [
                        'date' => Carbon::parse($data['departure'])->format('Y-m-d'),
                    ],
                ],
                [
                    'id'                      => '2',
                    'originLocationCode'      => $data['destination'],
                    'destinationLocationCode' => $data['origin'],
                    'departureDateTimeRange'  => [
                        'date' => Carbon::parse($data['arrival'])->format('Y-m-d'),
                    ],
                ],
            ],
            'searchCriteria'     => [
                'maxFlightOffers' => '20',
                'flightFilters'   => [
                    'cabinRestrictions' => [
                        [
                            'cabin'                => $data['cabin'],
                            'coverage'             => 'MOST_SEGMENTS',
                            'originDestinationIds' => [
                                '1',
                            ],
                        ],

                    ],
                    'connectionRestriction' => [
                        'maxNumberOfConnections' => (bool)$data['layovers'] ? '2' : '0',
                    ],
                ],
            ],
        ];

        $amadeus = new AmadeusConnector();
        $response = $amadeus->post('v2/shopping/flight-offers', $body);

        if (isset($response->data)) {
            return FlightOfferResource::collection(collect($response->data));
        } else {
            return response()->json(['message' => 'No offers found'], 404);
        }
    }

    public function test()
    {
        $body = [
            'currencyCode'       => 'EUR',
            'travelers'          => [
                [
                    'id'           => '1',
                    'travelerType' => 'ADULT',
                ],

            ],
            'sources'            => [
                'GDS',
            ],
            'originDestinations' => [
                [
                    'id'                      => '1',
                    'originLocationCode'      => 'AMS',
                    'destinationLocationCode' => 'SYD',
                    'departureDateTimeRange'  => [
                        'date' => '2021-05-01', // Carbon::now()->addWeeks(5)->format('Y-m-d'),
                    ],
                ],
                [
                    'id'                      => '2',
                    'originLocationCode'      => 'SYD',
                    'destinationLocationCode' => 'AMS',
                    'departureDateTimeRange'  => [
                        'date' => '2021-06-01', // Carbon::now()->addWeeks(6)->format('Y-m-d'),
                    ],
                ],
            ],
            'searchCriteria'     => [
                'maxFlightOffers' => '10',
                'flightFilters'   => [
                    'cabinRestrictions' => [
                        [
                            'cabin'                => 'BUSINESS',
                            'originDestinationIds' => [
                                '1',
                            ],
                        ],

                    ],
                ],
                'connectionRestriction' => [
                    'maxNumberOfConnections' => '9', // (bool)$data['layovers'] ? '9' : '0',
                ],
            ],
        ];

        $amadeus = new AmadeusConnector();
        $response = $amadeus->post('v2/shopping/flight-offers', $body);

        return FlightOfferResource::collection(collect($response->data));
    }
}
