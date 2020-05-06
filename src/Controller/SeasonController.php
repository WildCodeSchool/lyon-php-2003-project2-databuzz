<?php

namespace App\Controller;

use App\Model\SeasonManager;
use App\Model\GenreManager;
use App\Service\API\APITvShowManager;

class SeasonController extends AbstractController
{
    /**
     * Display Season Page
     *
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function index(int $tvshowId, int $seasonId, int $seasonNumber, int $episodeCount)
    {
        $apiTvShow = new APITvShowManager();

        // Get episodes array from API (with season info and episodes infos)
        // id, synopsis, season number, year...
        $seasonAndEpisodes = $apiTvShow->getEpisodes($tvshowId, $seasonNumber);

        // Check if season is stored in DB and store it in $season variable
        $seasonManager = new SeasonManager();
        $season = $seasonManager->selectOneById($seasonAndEpisodes['id']);

        // If season is not stored in DB, retrieve data from API
        if (!$season) {
            // Then, insert it into DB - $episodes has all the data of the season
            $seasonManager->insert($seasonAndEpisodes, $episodeCount, $tvshowId);

            // Then, retrieve season info from DB in $season variable
            $season = $seasonManager->selectOneById($seasonId);
        }

        $tvshowSeasons = $seasonManager->getSeasonsByShow($tvshowId);
        $tvshow = $seasonManager->getShowBySeason($seasonId);
        $genreManager = new GenreManager();
        $genres = $genreManager->getGenresBySeason($seasonId);

        return $this->twig->render(
            'Season/season.html.twig',
            [
                'season' => $season,
                'genres' => $genres,
                'episodes' => $seasonAndEpisodes,
                'tvshow' => $tvshow,
                'tvshowSeasons' => $tvshowSeasons
            ]
        );
    }
}
