<?php


namespace App\Service\API;

use Symfony\Component\HttpClient\HttpClient; /* Appel de la classe HTTP Client de Symfony */

class APIAbstractManager
{
    protected $client;

    protected $baseUrl = "https://api.themoviedb.org/3/";

    protected $apiKey = "?api_key=" . API_KEY;

    public function __construct()
    {
        $this->client = HttpClient::create();
    }

    public function getOneById(int $id)
    {
        $response = $this->client->request('GET', $this->baseUrl . 'tv/'  . $id . $this->apiKey);

        $result = $response->toArray();
        return $result;
    }
}
