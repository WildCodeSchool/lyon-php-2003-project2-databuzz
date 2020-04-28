<?php
/**
 * Created by PhpStorm.
 * User: aurelwcs
 * Date: 08/04/19
 * Time: 18:40
 */

namespace App\Controller;

use App\Model\GenreManager;
use App\Model\TvshowManager;
use App\Service\API\APITvShowManager;

class TvshowController extends AbstractController
{

    /**
     * Display home page
     *
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */

    /**
     * Display item informations specified by $id
     *
     * @param int $id
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */

    public function show(int $id)
    {
        $tvshowManager = new TvshowManager();
        $tvshow = $tvshowManager->selectOneById($id);
        $genresManager = new genreManager();
        $genres = $genresManager->getGenresByShow($id);
        $isBuzzed = $tvshowManager->isBuzzed($id, !empty($_SESSION) ? $_SESSION['user']['id'] : 0);
        $api = new APITvShowManager();
        $actors = $api->getActors($id);
        $seasons = $api->getSeasons($id);

        return $this->twig->render(
            'Tvshow/tvshow.html.twig',
            [
                'tvshow' => $tvshow,
                'genres' => $genres,
                'buzzed' => $isBuzzed,
                'actors' => $actors,
                'seasons' => $seasons,
                'sessions' => $_SESSION
            ]
        );
    }

    public function buzz(int $showid)
    {
        $tvshowManager = new TvshowManager();
        $tvshowManager->buzzTvShow($showid, $_SESSION['user']['id']);
        header('Location: /tvshow/show/' . $showid);
    }

    public function unbuzz(int $showid)
    {
        $tvshowManager = new TvshowManager();
        $tvshowManager->unbuzzTvShow($showid, $_SESSION['user']['id']);
        header('Location: /tvshow/show/' . $showid);
    }
}
