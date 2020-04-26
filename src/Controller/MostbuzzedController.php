<?php
/**
 * Created by PhpStorm.
 * User: aurelwcs
 * Date: 08/04/19
 * Time: 18:40
 */

namespace App\Controller;

use App\Model\AbstractManager;
use App\Model\BuzzManager;
use App\Model\MostbuzzedManager;
use App\Model\GenreTvshowManager;

class MostbuzzedController extends AbstractController
{

    /**
     * Display all tvshow informations
     *
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */

    public function show()
    {
        $mostbuzzedManager = new MostbuzzedManager();
        $tvshows = $mostbuzzedManager->selectAllTvShow();

        return $this->twig->render('Mostbuzzed/index.html.twig', ['tvshows' => $tvshows]);
    }


    /**
     * Display all tvshow informations
     *
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */

    public function genre()
    {
        $genreTvshowManager = new GenreTvshowManager();
        $tvgenres = $genreTvshowManager->selectByGenre();

        return $this->twig->render('Mostbuzzed/tvshowbygenre.html.twig', ['tvgenres' => $tvgenres]);
    }

    /**
     * Display all tvshow informations
     *
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */

    public function buzz()
    {
        $buzzManager = new BuzzManager();
        $buzzes = $buzzManager->selectNbBuzzed();

        return $this->twig->render('Mostbuzzed/buzz.html.twig', ['buzzes' => $buzzes]);
    }
}
