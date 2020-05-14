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
        /*$api = new APITvShowManager();
        $genres = $api->getGenres();
        var_dump($genres);
        foreach ($genres as $genre) {
            $genre_id[] = $genre['id'];
        }
        $key = array_rand($genre_id, 3);
        //var_dump($genre_id);
        //$recoByGenre1 = $api->getRecommendationsByGenre($genre_id[$key[0]]);
        $recoByGenre2 = $api->getRecommendationsByGenre($genre_id[$key[1]]);
        $recoByGenre3 = $api->getRecommendationsByGenre($genre_id[$key[2]]);
        //echo array_rand($genre_id);


        $buzzManager = new BuzzManager();
        $buzzes = $buzzManager->selectNbBuzzed();
        //var_dump($buzzes);

        $recoByGenre1 = $buzzManager->selectTvshowByGenre(35);
        echo $genre_id[$key[0]];
        var_dump($recoByGenre1);*/

        return $this->twig->render('Home/index.html.twig'/*, [
            'buzzes' => $buzzes,
            'genres' => $genres,
            'recobygenre1' => $recoByGenre1,
            'recobygenre2' => $recoByGenre2,
            'recobygenre3' => $recoByGenre3,
            ]*/);
    }
}
