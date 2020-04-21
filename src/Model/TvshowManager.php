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
class TvshowManager extends AbstractManager
{
    /**
     *
     */
    const TABLE = 'tvshow';

    /**
     *  Initializes this class.
     */
    public function __construct()
    {
        parent::__construct(self::TABLE);
    }
    public function getGenre(int $id)
    {
        // prepared request
        $statement = $this->pdo->prepare("SELECT genre.name FROM $this->table, genre JOIN genre_tvshow gt on genre.id = gt.genre_id WHERE $this->table.id = :id;");
        $statement->bindValue('id', $id, \PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetchAll();
    }
}
