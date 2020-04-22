<?php
/**
 * Created by PhpStorm.
 * User: aurelwcs
 * Date: 08/04/19
 * Time: 18:40
 */

namespace App\Controller;

use App\Model\TvshowManager;

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
    public function index()
    {
        return $this->twig->render('Tvshow/tvshow.html.twig');
    }

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
        $tvshow = new TvshowManager();
        $tvshow = $tvshow->selectOneById($id);
        $genre = new TvshowManager();
        $genre = $genre->getGenre($id);

        return $this->twig->render('Tvshow/tvshow.html.twig', ['tvshow' => $tvshow, 'genres' => $genre]);
    }
}
