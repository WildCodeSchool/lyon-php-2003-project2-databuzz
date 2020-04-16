<?php


namespace App\Controller;


class SignUpController extends AbstractController
{

    /**
     * Display SignUp page
     *
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function index()
    {
        return $this->twig->render('SignUp/signup.html.twig');
    }
}
