<?php

namespace App\Connectors\Amadeus;

use App\Connectors\Methods\PostMethod;
use App\Connectors\Methods\GetMethod;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use App\Connectors\ApiConnector;
use App\Models\Reference;
use Exception;

class AmadeusConnector implements ApiConnector, PostMethod, GetMethod
{
    private $baseUrl;
    private $authenticationEndpoint;
    private $token;
    private $tokenEol;
    private $clientId;
    private $clientSecret;

    public function __construct()
    {
        $this->baseUrl = config('apis.amadeus.base_url');
        $this->authenticationEndpoint = config('apis.amadeus.authentication_endpoint');
        $this->clientId = config('apis.amadeus.client_id');
        $this->clientSecret = config('apis.amadeus.client_secret');
    }

    /**
     * Check authentication, renew token if needed
     *
     * @return ApiConnector
     */
    public function authenticate(): ApiConnector
    {
        if (is_null($this->tokenEol) || now() <= $this->tokenEol) {
            $data = [
                'grant_type'    => 'client_credentials',
                'client_id'     => $this->clientId,
                'client_secret' => $this->clientSecret,
            ];

            $headers = [
                'Content-Type: application/x-www-form-urlencoded',
            ];

            try {
                $response = Http::asForm()->withHeaders($headers)->post($this->baseUrl . $this->authenticationEndpoint, $data);
                $responseBody = json_decode($response->body());
                $this->token = $responseBody->access_token;
                $this->tokenEol = now()->addSeconds($responseBody->expires_in);
            } catch (Exception $exception) {
                Log::error($exception->getMessage());
            }
        }

        return $this;
    }

    /**
     * Make HTTP GET request
     *
     * @param string $endpoint
     * @return mixed
     */
    function get(string $endpoint)
    {
        $this->authenticate();

        $response = json_decode(Http::withToken($this->token)->get($this->baseUrl . $endpoint)->body());

        if (isset($response->dictionaries)) {
            Reference::updater($response->dictionaries);
        }

        return $response;
    }

    /**
     * Make HTTP POST request
     *
     * @param string $endpoint
     * @param array $body
     * @return mixed
     */
    function post(string $endpoint, array $body)
    {
        $this->authenticate();

        $response = json_decode(Http::withToken($this->token)->post($this->baseUrl . $endpoint, $body)->body());

        if (isset($response->dictionaries)) {
            Reference::updater($response->dictionaries);
        }

        return $response;
    }
}
