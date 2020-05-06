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

    public function getSeasonsByShow(int $id)
    {
        // prepared request
        $statement = $this->pdo->prepare("
            SELECT id, tvshow_id, season_number, nbEpisodes, synopsis, img, year FROM $this->table
            WHERE tvshow_id = :id
            ORDER BY season_number;
            ");

        $statement->bindValue('id', $id, \PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetchAll();
    }
}
