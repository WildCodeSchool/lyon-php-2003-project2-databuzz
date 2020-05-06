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
        $formValidator = new FormValidator();
        $errors = [];

        if (!empty($_POST)) {
            // Check if email is already used
            $userManager = new UserManager();
            $user = $userManager->selectOneByEmail(trim($_POST['email']));
            if ($user != false) {
                $errors['email'] = "This email is already used";
            } else {
                // Check if both passwords are matching, if not, add error to array
                if (!$formValidator->matchingPasswords($_POST['password'], $_POST['password2'])) {
                    $errors = $formValidator->getErrors();
                } else {
                    // call to validateInput function to checks input and return true if no errors, false if errors
                    $formValidator->validateInput($_POST);
                }
                // get the errors and cleanedInput arrays from formValidator Object
                $errors = $formValidator->getErrors();
                $cleanedInput = $formValidator->getCleanedInput();

                // If no errors, the cleaned input is sent to the UserManager
                if (empty($errors)) {
                    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
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
        $email = $password = "";

        // Checks validity of input given
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
                    // password_verify is used to check an input pwd and a hashed password
                    if (password_verify($password, $user['password'])) {
                        $_SESSION['user'] = [
                            "id" => $user['id'],
                            "username" => $user['username'],
                            "firstname" => $user['firstname'],
                            "lastname" => $user['lastname'],
                            "email" => $user['email'],
                        ];
                        header('location: /');
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

    public function signout()
    {
        if (isset($_SESSION['user'])) {
            unset($_SESSION['user']);
        }
        header('location: /');
    }
}
