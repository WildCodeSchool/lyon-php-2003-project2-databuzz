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

            // Validate each input after another and store the errors or the cleaned input in an array
            // Switch verifies type of input
            // by default, manager si set as VARCHAR 255
            // email has VARCHAR 320 so we modify the constaint array of the validateInput function
            foreach ($_POST as $type => $input) {
                switch ($type) {
                    case 'email':
                        if (!$formValidator->validateInput($input, ['required' => true, 'maxLength' => 320])) {
                            $errors[$type] = $formValidator->getErrors();
                        }
                        break;
                    default:
                        if (!$formValidator->validateInput($input)) {
                            $errors[$type] = $formValidator->getErrors();
                        }
                        break;
                }
                $cleanedInput[$type] = $formValidator->getCleanedInput();
            }

            // Check if both passwords are matching, if not, add error to array
            if (!$formValidator->matchingPasswords($_POST['password'], $_POST['password2'])) {
                $errors['password2'] = $formValidator->getErrors();
            }

            // If no errors, the input is sent to the SignUpManager
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
