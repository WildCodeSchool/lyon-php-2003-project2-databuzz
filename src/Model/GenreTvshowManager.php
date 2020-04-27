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

    /**
     * Get all row from database.
     *
     * @return array
     */
    public function selectOrderByGenre(): array
    {
        // prepared request
        return $this->pdo->query("
            SELECT DISTINCT genre.name, genre.id, tvshow.id
            FROM $this->table
            JOIN tvshow ON tvshow.id = genre_tvshow.tvshow_id
            JOIN genre ON genre.id = genre_tvshow.genre_id")->fetchAll();
    }
}
