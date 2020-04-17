<?php


namespace App\Model;

class SignUpManager extends AbstractManager
{
    /**
     *
     */
    const TABLE = 'USER';

    /**
     *  Initializes this class.
     */
    public function __construct()
    {
        parent::__construct(self::TABLE);
    }
}
