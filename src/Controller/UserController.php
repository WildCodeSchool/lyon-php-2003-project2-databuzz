<?php


namespace App\Controller;

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
    public function show()
    {
        if (!isset($_SESSION['user'])) {
            header('location /auth.signin');
        } else {
            return $this->twig->render('User/account.html.twig');
        }
    }
}
