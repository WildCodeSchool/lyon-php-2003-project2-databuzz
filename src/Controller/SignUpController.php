<?php


namespace App\Controller;

use App\Model\SignUpManager;

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

    /**
     * Display item informations specified by $id
     *
     * @param int $id
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function show(int $id)
    {
        $signUp = new SignUpManager();
        $signUp = $signUp->selectOneById($id);

        return $this->twig->render('SignUp/signup.html.twig', ['signUp' => $signUp]);
    }
}
