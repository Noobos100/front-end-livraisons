<?php

namespace api;

/**
 * Class APIHandler
 * @package api
 * Cette classe permet de récupérer des données depuis une API
 * Elle contient une méthode fetchFromAPI qui prend une URL en paramètre et retourne les données récupérées
 * depuis l'API sous forme de tableau associatif
 */
class APIHandler
{
    /**
     * @param $url
     * @return mixed
     */
    public function fetchFromAPI($url)
    {
        $json = file_get_contents($url);
        $data = json_decode($json, true);
        return $data;
    }
}