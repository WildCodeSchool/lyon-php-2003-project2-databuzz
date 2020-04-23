<?php

namespace App\Controller;

use App\Model\SeasonManager;
use App\Model\GenreManager;

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
    public function index($id)
    {
        $episodes = [
            "un" => [
                "air_date" => "2015-06-17",
                "name" => "Jim Carrey: We Love Breathing What You're Burning, Baby",
                "episode_number" => 3,
                "overview" => "Jerry’s full of testosterone as he steps into a ‘76 Lamborghini Countach with Jim Carrey,
                 who’s between a three-week cleanse and a five-day silent retreat. After coffee, it’s off to Carrey’s 
                 studio to study a portrait of a gorilla with a machine gun. Wow.",
            ],
            "deux" => [
                "air_date" => "2015-07-08",
                "name" => "Stephen Colbert: Cut Up And Bloody But Looking Good",
                "episode_number" => 6,
                "overview" => "Jerry rides shotgun with Stephen Colbert in a 1964 Morgan Plus 4, a British import that 
                says you just don’t care what people think. He’s a late-night madman, according to Jerry, who’s 
                impressed with Colbert’s beard and the manly way he pretends to smoke a pipe.",
            ]
        ];
        $seasonManager = new SeasonManager();
        $season = $seasonManager->selectOneById($id);
        $tvshow = $seasonManager->getShowBySeason($id);
        $genreManager = new GenreManager();
        $genres = $genreManager->getGenreBySeason($id);
        return $this->twig->render('Season/season.html.twig', ['season' => $season,
            'genres' => $genres, 'episodes' => $episodes, 'tvshow' => $tvshow]);
    }
}
