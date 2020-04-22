<?php


namespace App\Service\API;

use Symfony\Component\HttpClient\HttpClient;
class APIAbstractManager
{
    protected $client;

    protected $baseUrl = "https://api.themoviedb.org/3/";

    protected $apiKey = "?api_key=".API_KEY;

    public function __construct(string $resource)
    {
        $this->client = HttpClient::create();
        $this->baseUrl .= $resource;
    }

    public function getOneById(int $id)
    {
        $response = $this->client->request('GET', $this->baseUrl . $id. $this->apiKey);

        $result = $response->toArray();
        return $result;
    }
}