<?php

/**
 * Created by PhpStorm.
 * User: sylvain
 * Date: 07/03/18
 * Time: 18:20
 * PHP version 7
 */

namespace App\Model;

/**
 *
 */
class GenreTvshowManager extends AbstractManager
{
    /**
     *
     */
    const TABLE = 'genre_tvshow';

    /**
     *  Initializes this class.
     */
    public function __construct()
    {
        parent::__construct(self::TABLE);
    }

    /** METHODE MANAGER POUR AFFICHER LES SERIES PAR GENRE A PARTIR DU DB*/
    /**
     * Get all row from database.
     *
     * @return array
     */
    public function selectByGenre(): array
    {
        // prepared request
        return $this->pdo->query("
            SELECT tvshow.img, tvshow.title, tvshow.year, tvshow.synopsis, genre.name
            FROM $this->table
            JOIN genre ON genre.id = genre_tvshow.genre_id
            JOIN tvshow ON tvshow.id = genre_tvshow.tvshow_id
            ORDER BY genre.name")->fetchAll();
    }
}
