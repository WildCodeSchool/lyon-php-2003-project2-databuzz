<?php


namespace App\Model;

class TvshowGenreManager extends AbstractManager
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

    public function insert(array $data)
    {
        // prepared request
        foreach ($data['genres'] as $genreId) {
            $statement = $this->pdo->prepare("INSERT INTO $this->table
                                (`genre_id`, `tvshow_id`)
                                 VALUES (:genre_id, :tvshow_id)");
            $statement->bindValue('genre_id', $genreId['id'], \PDO::PARAM_INT);
            $statement->bindValue('tvshow_id', $data['id'], \PDO::PARAM_INT);

            $statement->execute();
        }
    }
}
