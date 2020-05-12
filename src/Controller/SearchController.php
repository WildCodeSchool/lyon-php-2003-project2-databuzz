<?php
/**
 * Created by PhpStorm.
 * User: aurelwcs
 * Date: 08/04/19
 * Time: 18:40
 */

namespace App\Controller;

use App\Model\BuzzManager;
use App\Service\API\APITvShowManager;

class SearchController extends AbstractController
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
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function index()
    {
        $string = $_POST['search'];
        $searchAPI = new APITvShowManager();
        $searchResultsAPI = $searchAPI->searchTvShow($string);
        $buzzs = new BuzzManager();
        $index = 0;
        foreach ($searchResultsAPI['results'] as $singleResult) {
            $searchResultsAPI['results'][$index]['buzzs'] = $buzzs->getBuzzTvShow($singleResult['id']);
            $index++;
        }
        return $this->twig->render('Search/index.html.twig', ['searchAPI' => $searchResultsAPI]);
    }
}
