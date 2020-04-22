<?php


namespace App\Controller;

use App\Model\SignUpManager;
use App\Utils\FormValidator;

class SignUpController extends AbstractController
{

    /**
     * Display signup page
     *
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function register()
    {
        $errors = [];
        $cleanedInput = [];

        if (!empty($_POST)) {
            $formValidator = new FormValidator();
            var_dump($_POST);
            foreach ($_POST as $type => $input) {
                if (!$formValidator->validateInput($input)) {
                    $errors[$type] = $formValidator->getErrors();
                } else {
                    $cleanedInput[$type] = $formValidator->getCleanedInput();
                }
            }

            if (!$formValidator->matchingPasswords($_POST['password'], $_POST['password2'])) {
                $errors['password2'] = $formValidator->getErrors();
            }

            // If no errors, we send the input to the SignUpManager
            if (empty($errors)) {
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $signupManager = new SignUpManager();
                    $user = [
                        'username' => $cleanedInput['username'],
                        'firstname' => $cleanedInput['firstname'],
                        'lastname' => $cleanedInput['lastname'],
                        'email' => $cleanedInput['email'],
                        'password' => $cleanedInput['password'],
                    ];
                    $signupManager->insert($user);

                    return $this->twig->render(
                        'SignUp/signup.html.twig',
                        ['newUser' => $cleanedInput['username']]
                    );
                }
            }
        }
        return $this->twig->render('SignUp/signup.html.twig', ['errors' => $errors, 'inputs' => $_POST]);
    }
}
