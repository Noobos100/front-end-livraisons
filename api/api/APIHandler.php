<?php

namespace api;

class APIHandler
{
    public function fetchFromAPI($url)
    {
        $json = file_get_contents($url);
        $data = json_decode($json, true);
        return $data;
    }
}