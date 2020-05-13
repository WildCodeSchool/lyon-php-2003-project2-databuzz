<?php


namespace App\Controller;

use App\Model\UserManager;
use App\Model\FriendManager;

class UserController extends AbstractController
{
    /**
     * Display User page
     *
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function index()
    {
        if (!isset($_SESSION['user'])) {
            header('location /auth/signin');
        } else {
            $errors = [];
            $friendID = "";

            // Retrieve list of friends from DataBase
            $friendManager = new FriendManager();
            var_dump($_POST);
            // if $_Post is set, addFriend has been used and should be added to DB
            // need 2 $id, one for current user $_SESSION['user']['id'], and friend's one $_POST['addFriend']
            if (!empty($_POST)) {
                $friendID = trim($_POST['addFriend']);
                if (empty($friendID)) {
                        $errors['friendID'] = "Your friend's ID is required";
                } else {
                    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                        $friendManager->addFriendToDB($_SESSION['user']['id'], $friendID);
                    }
                }
            }

            return $this->twig->render('User/account.html.twig', ['errors' => $errors]);
        }
    }
}
