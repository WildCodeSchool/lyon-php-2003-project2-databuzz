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
class MostbuzzedManager extends AbstractManager
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


    /**
     * Get all row from database.
     *
     * @return array
     */
    public function selectAllTvShow(): array
    {
        return $this->pdo->query('SELECT * FROM ' . $this->table)->fetchAll();
    }


}
