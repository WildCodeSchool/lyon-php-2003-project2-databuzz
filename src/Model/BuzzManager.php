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
class BuzzManager extends AbstractManager
{
    /**
     *
     */
    const TABLE = 'buzz';

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
    public function selectNbBuzzed(): array
    {
        return $this->pdo->query("
            SELECT tvshow.img, COUNT(buzz.tvshow_id) AS nb_buzz
            FROM $this->table
            RIGHT JOIN tvshow ON tvshow.id = buzz.tvshow_id
            GROUP BY tvshow.img
            ORDER BY nb_buzz DESC
            ")->fetchAll();
    }

    /**
     * Get one row from database by ID.
     *
     * @param  int $id
     *
     * @return array
     */
    public function selectTvshowByGenre($id): array
    {
        $statement = $this->pdo->prepare("SELECT tvshow.img, COUNT(buzz.tvshow_id) AS nb_buzz
            FROM $this->table
            RIGHT JOIN tvshow ON tvshow.id = buzz.tvshow_id
            JOIN genre_tvshow ON genre_tvshow.tvshow_id = tvshow.id AND genre_tvshow.genre_id = :id
            GROUP BY tvshow.id
            ORDER BY nb_buzz DESC");
        $statement->bindValue('id', $id, \PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetchAll();
    }

    public function getBuzzTvShow($id): array
    {
        $statement = $this->pdo->prepare("SELECT COUNT(buzz.tvshow_id) AS nb_buzz
            FROM $this->table
            WHERE buzz.tvshow_id=:id");
        $statement->bindValue('id', $id, \PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetch();
    }
}
