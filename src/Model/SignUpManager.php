<?php


namespace App\Model;

class SignUpManager extends AbstractManager
{
    /**
     *
     */
    const TABLE = 'user';

    /**
     *  Initializes this class.
     */
    public function __construct()
    {
        parent::__construct(self::TABLE);
    }

    /**
     * @param array $user
     * @return int
     */
    public function insert(array $user)
    {
        // prepared request
        $statement = $this->pdo->prepare("INSERT INTO $this->table
                                (`username`, `firstname`,`lastname`,`email`,`password`)
                                 VALUES (:username, :firstname, :lastname, :email, :password)");
        $statement->bindValue('username', $user['username'], \PDO::PARAM_STR);
        $statement->bindValue('firstname', $user['firstname'], \PDO::PARAM_STR);
        $statement->bindValue('lastname', $user['lastname'], \PDO::PARAM_STR);
        $statement->bindValue('email', $user['email'], \PDO::PARAM_STR);
        $statement->bindValue('password', $user['password'], \PDO::PARAM_STR);

        $username = $user['username'];
        if ($statement->execute()) {
            return $username;
        }
    }
}
