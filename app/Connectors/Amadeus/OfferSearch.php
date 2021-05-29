<?php


namespace App\Connectors\Amadeus;


use Carbon\Carbon;

class OfferSearch implements MessageBody
{
    /**
     * Generate Offer Search message body
     *
     * @param array $data
     * @return array
     */
    public static function generateBody(array $data): array
    {
        return [
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
                    'cabinRestrictions'     => [
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
    }
}
