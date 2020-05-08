<?php


namespace App\Service\API;

class APITvShowManager extends APIAbstractManager
{
    const RESOURCE = "tv/";

    public function __construct()
    {
        parent::__construct(self::RESOURCE);
    }

    public function getActors($id)
    {
        $response = $this->client->request('GET', $this->baseUrl . $id. '/credits' . $this->apiKey);
        $credits = $response->toArray();
        return $credits['cast'];
    }
    public function getSeasons($id)
    {
        $response = $this->client->request('GET', $this->baseUrl . $id. $this->apiKey);
        $seasons = $response->toArray();
        return $seasons['seasons'];
    }
    public function getRecommendations($id)
    {
        $response = $this->client->request('GET', $this->baseUrl . $id . '/recommendations' . $this->apiKey);
        $recommendations = $response->toArray();

        return $recommendations['results'];
    }
}
