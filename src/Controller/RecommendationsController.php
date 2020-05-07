<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 11/10/17
 * Time: 16:07
 * PHP version 7
 */

namespace App\Controller;

//use App\Service\API\APIRecommendationsManager;
use Symfony\Component\HttpClient\HttpClient;

/**
 * Class ItemController
 *
 */
class RecommendationsController extends AbstractController
{


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
        $client = HttpClient::create();
        $response = $client->request('GET', 'https://api.themoviedb.org/3/tv/' . $id . '/recommendations' .
            '?api_key=b57985ea6074227451ffbe0942972344');
        $recommendations = $response->toArray();

        return $this->twig->render('Tvshow/recommendations.html.twig', ['recommendations' => $recommendations]);
    }
}
