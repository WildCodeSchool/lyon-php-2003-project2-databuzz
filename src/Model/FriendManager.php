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
        // Check if not already in DB: search for the couple of ID in the two possible orders
        if ($this->checkFriendsInDB($userId, $friendId) === false) {
            // If not found, we put it in DB
            // prepared request
            $statement = $this->pdo->prepare("INSERT INTO $this->table
                                (`user_id_1`, `user_id_2`)
                                 VALUES (:user_id_1, :user_id_2)");
            $statement->bindValue('user_id_1', $userId, \PDO::PARAM_INT);
            $statement->bindValue('user_id_2', $friendId, \PDO::PARAM_INT);

            $statement->execute();
            return true;
        } else {
            // if friend couple already in DB
            return false;
        }
    }

    public function checkFriendsInDB($id1, $id2)
    {
        $statement = $this->pdo->prepare(
            "SELECT * FROM $this->table 
                        WHERE (user_id_1=:user_id_1 AND user_id_2=:user_id_2) 
                        OR (user_id_1=:user_id_2 AND user_id_2=:user_id_1)"
        );
        $statement->bindValue('user_id_1', $id1, \PDO::PARAM_INT);
        $statement->bindValue('user_id_2', $id2, \PDO::PARAM_INT);

        if ($statement->execute()) {
            return $statement->fetch();
        } else {
            return false;
        }
    }
}
