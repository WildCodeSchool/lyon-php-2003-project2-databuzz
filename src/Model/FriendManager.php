<?php


namespace App\Model;

class FriendManager extends AbstractManager
{
    /**
     *
     */
    const TABLE = 'friends';

    /**
     *  Initializes this class.
     */
    public function __construct()
    {
        parent::__construct(self::TABLE);
    }

    public function addFriendToDB($userId, $friendId)
    {
        // prepared request
        $statement = $this->pdo->prepare("INSERT INTO $this->table
                                (`user_id_1`, `user_id_2`)
                                 VALUES (:user_id_1, :user_id_2)");
        $statement->bindValue('user_id_1', $userId, \PDO::PARAM_INT);
        $statement->bindValue('user_id_2', $friendId, \PDO::PARAM_INT);

        $statement->execute();
    }
}
