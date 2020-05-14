<?php


namespace App\Controller;

use App\Model\BuzzManager;
use App\Model\FriendManager;
use App\Model\UserManager;

class FriendsController extends AbstractController
{
    public function index($id)
    {
        $userManager = new UserManager();
        $userInfo = $userManager->selectOneById($id);

        $buzzManager = new BuzzManager();
        $buzzedTvshows = $buzzManager->getBuzzByUser($id);

        return $this->twig->render('User/friends.html.twig', ['userInfo' =>$userInfo, 'shows' => $buzzedTvshows]);
    }

    public function delete($friendId)
    {
        $userID = $_SESSION['user']['id'];
        $friendManager = new FriendManager();
        $friendManager->deleteFriend($userID, $friendId);

        header("location: /user/index");
    }
}
