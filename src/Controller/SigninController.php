<?php


namespace App\Controller;

use App\Utils\FormValidator;
use App\Model\SigninManager;

class SigninController extends AbstractController
{
    /**
     * Display signin page
     *
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function login()
    {
        $errors = [];

        // Clean input
        // Check with SigninManager if email matches
        // If email matches, user is signed in and user info is stored in S_SESSION

        return $this->twig->render('SignUp/signup.html.twig', ['errors' => $errors, 'inputs' => $_POST]);
    }
}
