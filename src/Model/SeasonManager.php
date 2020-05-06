<?php

namespace App\Model;

class SeasonManager extends AbstractManager
{
    /**
     *
     */
    const TABLE = 'season';

    /**
     *  Initializes this class.
     */
    public function __construct()
    {
        parent::__construct(self::TABLE);
    }

    public function getShowBySeason(int $id)
    {
        // prepared request
        $statement = $this->pdo->prepare("
            SELECT tvshow.id, tvshow.img, tvshow.title, tvshow.synopsis, tvshow.year FROM tvshow
            JOIN season ON tvshow.id = season.tvshow_id
            WHERE season.id = :id;
            ");

        $statement->bindValue('id', $id, \PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetch();
    }
    // Function use to insert Seasons data into the DB from the API
    public function insert(array $seasonInfo, int $nbEpisodes, int $tvShowId)
    {
        // prepared request
        $statement = $this->pdo->prepare("INSERT INTO $this->table
                                (`id`, `tvshow_id`,`season_number`,`nbEpisodes`,`synopsis`,`img`, `year`)
                                 VALUES (:id, :tvshow_id, :season_number, :nbEpisodes, :synopsis, :img, :year)");
        $statement->bindValue('id', $seasonInfo['id'], \PDO::PARAM_INT);
        $statement->bindValue('tvshow_id', $tvShowId, \PDO::PARAM_INT);
        $statement->bindValue('season_number', $seasonInfo['season_number'], \PDO::PARAM_INT);
        $statement->bindValue('nbEpisodes', $nbEpisodes, \PDO::PARAM_STR);
        $statement->bindValue('synopsis', $seasonInfo['overview'], \PDO::PARAM_STR);
        $statement->bindValue(
            'img',
            "https://image.tmdb.org/t/p/w1920_and_h800_multi_faces/".$seasonInfo['poster_path'],
            \PDO::PARAM_STR
        );
        $statement->bindValue('year', substr($seasonInfo['air_date'], 0, 4), \PDO::PARAM_INT);

        if ($statement->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
