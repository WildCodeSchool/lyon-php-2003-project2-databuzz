<?php
/**
 * Created by PhpStorm.
 * User: aurelwcs
 * Date: 08/04/19
 * Time: 18:40
 */

namespace App\Controller;

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
        $genres = $tvshowManager->getGenres($id);
        $isBuzzed = $tvshowManager->isBuzzed($id, 1);
        $api = new APITvShowManager();
        $actors = $api->getActors($id);

        return $this->twig->render(
            'Tvshow/tvshow.html.twig',
            ['tvshow' => $tvshow, 'genres' => $genre, 'actors'=>$actors]
        );
    }

    public function buzz(int $showid, int $userid)
    {
        $tvshowManager = new TvshowManager();
        $tvshowManager->buzzTvShow($showid, $userid);
        header('Location: /tvshow/show/' . $showid);
    }

    public function unbuzz(int $showid, int $userid)
    {
        $tvshowManager = new TvshowManager();
        $tvshowManager->unbuzzTvShow($showid, $userid);
        header('Location: /tvshow/show/' . $showid);
    }
}
