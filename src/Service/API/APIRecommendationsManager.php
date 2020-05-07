<?php


namespace App\Service\API;

class APIRecommendationsManager extends APIAbstractManager
{
    const RESOURCE = "tv/";

    public function __construct()
    {
        parent::__construct(self::RESOURCE);
    }

    public function getRecommendations($id)
    {
        $response = $this->client->request('GET', $this->baseUrl . $id . '/recommendations' . $this->apiKey);
        $recommendations = $response->toArray();
        return $recommendations['recommendations'];
    }
}
