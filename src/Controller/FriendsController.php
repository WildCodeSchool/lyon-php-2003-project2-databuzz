<?php


namespace App\Controller;

use App\Model\UserManager;

class FriendsController extends AbstractController
{
    public function index($id)
    {
        $userManager = new UserManager();
        $userInfo = $userManager->selectOneById($id);

        return $this->twig->render('User/friends.html.twig', ['userInfo' =>$userInfo]);
    }
}
