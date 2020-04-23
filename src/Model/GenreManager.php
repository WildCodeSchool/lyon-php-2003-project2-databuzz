<?php

namespace App\Model;

class GenreManager extends AbstractManager
{
    /**
     *
     */
    const TABLE = 'genre';

    /**
     *  Initializes this class.
     */
    public function __construct()
    {
        parent::__construct(self::TABLE);
    }

    public function getGenreByShow(int $id)
    {
        // prepared request
        $statement = $this->pdo->prepare("
            SELECT name FROM $this->table
            JOIN genre_tvshow AS gts ON genre.id = gts.genre_id 
            WHERE gts.tvshow_id = :id;
            ");
        $statement->bindValue('id', $id, \PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetchAll();
    }

    public function getGenreBySeason(int $id)
    {
        $statement = $this->pdo->prepare("
            SELECT name FROM $this->table 
            JOIN genre_tvshow AS gts ON genre.id = gts.genre_id
            JOIN season ON season.tvshow_id = gts.tvshow_id
            WHERE season.id = :id;
            ");
        $statement->bindValue('id', $id, \PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetchAll();
    }
}
