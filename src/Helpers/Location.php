<?php

namespace App\Helpers;

use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class Location
{
    public function __construct(private HttpClientInterface $client)
    {

    }

    /**
     * Récupère les coordonnées GPS depuis une adresse postale
     * @param string $address Adresse postale
     * @return array
     * @throws TransportExceptionInterface
     */
    public function getGPSCoordinatesFromPostalAddress(string $address): array
    {
        $url = "https://api-adresse.data.gouv.fr/search/?q=".$address."&type=housenumber&autocomplete=1";

        $request = $this->client->request('GET', $url);
        $response = $request->getContent();
        $response = json_decode($response, true);


        $latitude = $response["features"][0]["geometry"]["coordinates"][0];
        $longitude = $response["features"][0]["geometry"]["coordinates"][1];

        return ["latitude" => $latitude, "longitude" => $longitude];
    }
}