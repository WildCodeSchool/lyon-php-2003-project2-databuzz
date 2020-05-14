<?php
/**
 * Created by PhpStorm.
 * User: aurelwcs
 * Date: 08/04/19
 * Time: 18:40
 */

namespace App\Controller;

use App\Model\BuzzManager;
use App\Model\GenreManager;
use App\Model\GenreTvshowManager;
use App\Service\API\APIAbstractManager;
use App\Service\API\APITvShowManager;

class HomeController extends AbstractController
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
        $api = new APITvShowManager();
        $genres = $api->getGenres();

        $buzzManager = new BuzzManager();
        $buzzes = $buzzManager->selectNbBuzzed();

        $genreId = array();
        foreach ($genres as $genre) {
            $genreId[] = $genre['id'];
        }
        $key = array_rand($genreId, 4);
        $buzzByGenre1 = $buzzManager->selectTvshowByGenre($genreId[$key[0]]);
        $buzzByGenre2 = $buzzManager->selectTvshowByGenre($genreId[$key[1]]);
        $buzzByGenre3 = $buzzManager->selectTvshowByGenre($genreId[$key[2]]);
        $discovers = $api->getRecommendationsByGenre($genreId[$key[3]]);

        return $this->twig->render('Home/index.html.twig', [
            'buzzes' => $buzzes,
            'genres' => $genres,
            'buzzbygenre1' => $buzzByGenre1,
            'buzzbygenre2' => $buzzByGenre2,
            'buzzbygenre3' => $buzzByGenre3,
            'discovers' => $discovers
            ]);
    }
}
