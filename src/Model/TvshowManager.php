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

    public function buzzTvShow(int $showId, int $userId)
    {
        $statement = $this->pdo->prepare("INSERT INTO buzz VALUES (:userid,:showid);");
        $statement->bindValue('userid', $userId, \PDO::PARAM_INT);
        $statement->bindValue('showid', $showId, \PDO::PARAM_INT);
        $statement->execute();
    }

    public function unbuzzTvShow(int $showId, int $userId)
    {
        $statement = $this->pdo->prepare("DELETE FROM buzz WHERE user_id=:userid AND tvshow_id=:showid;");
        $statement->bindValue('userid', $userId, \PDO::PARAM_INT);
        $statement->bindValue('showid', $showId, \PDO::PARAM_INT);
        $statement->execute();
    }

    public function isBuzzed(int $showId, int $userId)
    {
        $statement = $this->pdo->prepare("SELECT * FROM buzz WHERE user_id=:userId AND tvshow_id=:showId;");
        $statement->bindValue('userId', $userId, \PDO::PARAM_INT);
        $statement->bindValue('showId', $showId, \PDO::PARAM_INT);
        $statement->execute();
        $result = $statement->fetch();

        if ($result) {
            return 1;
        } else {
            return 0;
        }
    }
}
