<?php
namespace App\Services;

use GuzzleHttp\Client;

class RajaOngkirService
{
    protected $client;

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => 'https://api.rajaongkir.com/starter/',
            'headers' => [
                'key' => env('RAJAONGKIR_API_KEY'),
            ],
        ]);
    }

    public function getProvinces()
    {
        $response = $this->client->get('province');
        return json_decode($response->getBody(), true);
    }

    public function getShippingCost($origin, $destination, $weight, $courier)
    {
        $response = $this->client->post('cost', [
            'form_params' => [
                'origin' => $origin,
                'destination' => $destination,
                'weight' => $weight,
                'courier' => $courier,
            ],
        ]);
        return json_decode($response->getBody(), true);
    }
}
