<?php


namespace App\Controller;

use App\Model\UserManager;
use App\Utils\FormValidator;

class AuthController extends AbstractController
{

    /**
     * Display signup page
     *
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function signup()
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

            // If no errors, the input is sent to the UserManager
            if (empty($errors)) {
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $userManager = new UserManager();
                    $user = [
                        'username' => $cleanedInput['username'],
                        'firstname' => $cleanedInput['firstname'],
                        'lastname' => $cleanedInput['lastname'],
                        'email' => $cleanedInput['email'],
                        'password' => $cleanedInput['password'],
                    ];
                    $username = $userManager->insert($user);

                    header("location: /Auth/signin/?username=$username");
                }
            }
        }
        return $this->twig->render('User/signup.html.twig', ['errors' => $errors, 'inputs' => $_POST]);
    }

    /**
     * Display signin page
     *
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function signin()
    {
        $errors = [];
        $email = $password= "";

        if (!empty($_POST)) {
            // Clean input
            $email = trim($_POST['email']);
            $password = $_POST['password'];

            if (empty($email)) {
                $errors['email'] = "Email is required";
            }
            if (empty($password)) {
                $errors['password'] = "Password is required";
            }

            // Check with SigninManager if email matches
            if (empty($errors)) {
                $userManager = new UserManager();
                $user = $userManager->selectOneByEmail($email);
                if (!$user) {
                    $errors['email'] = "Email does not match any email in our user list";
                } else {
                    // If password matches, user is signed in and user info is stored in S_SESSION
                    if ($password === $user['password']) {
                        $_SESSION['user'] = [
                            "id" => $user['id'],
                            "username" => $user['username'],
                            "email" => $user['email'],
                        ];
                        header('location: /HomePageVisitor');
                    } else {
                        $errors['password'] = "Invalid password";
                    }
                }
            }
        } elseif (!empty($_GET)) {
            $username = $_GET['username'];
            return $this->twig->render('User/signin.html.twig', ['username' => $username]);
        }

        return $this->twig->render('User/signin.html.twig', ['errors' => $errors, 'email' => $email]);
    }
}
