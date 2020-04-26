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
            SELECT tvshow.title, COUNT(buzz.tvshow_id) AS nb_buzz FROM $this->table
            JOIN tvshow ON tvshow.id = buzz.tvshow_id
            GROUP BY tvshow.title
            ORDER BY nb_buzz DESC
            ")->fetchAll();
    }
}
