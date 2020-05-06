<?php


namespace App\Service\API;

class APITvShowManager extends APIAbstractManager
{

    public function __construct()
    {
        parent::__construct();
    }

    public function getActors($id)
    {
        $response = $this->client->request('GET', $this->baseUrl . 'tv/' . $id . '/credits' . $this->apiKey);
        $credits = $response->toArray();
        return $credits['cast'];
    }

    public function getSeasons($id)
    {
        $response = $this->client->request('GET', $this->baseUrl . 'tv/' . $id. $this->apiKey);
        $seasons = $response->toArray();
        return $seasons['seasons'];
    }
    public function getEpisodes(int $tvShowId, int $seasonId)
    {
        $response =
            $this->client->request('GET', $this->baseUrl . 'tv/' . $tvShowId . "/season/" . $seasonId . $this->apiKey);
        return $response->toArray();
    }

    public function searchTvShow($query)
    {
        $response = $this->client->request('GET', $this->baseUrl . 'search/tv' . $this->apiKey . '&query=' . $query);
        $results = $response->toArray();
        return $results;
    }
}
