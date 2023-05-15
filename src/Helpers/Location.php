<?php

namespace App\Helpers;

class Location
{
    /**
     * Récupère les coordonnées GPS depuis une adresse postale
     * @param string $address Adresse postale
     * @return array
     */
    public static function getGPSCoordinatesFromPostalAddress(string $address): array
    {
        $url = "http://api.positionstack.com/v1/forward?access_key=fb949ffe1801fa3e53bab4e1a3d28de0&query=" . $address;
        $response = file_get_contents($url);
        $response = json_decode($response, true);
        $latitude = $response["data"][0]["latitude"];
        $longitude = $response["data"][0]["longitude"];

        return ["latitude" => $latitude, "longitude" => $longitude];
    }
}