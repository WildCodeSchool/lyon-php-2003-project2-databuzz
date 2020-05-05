<?php


namespace App\Utils;

class FormValidator
{
    /**
     * @var array
     */
    private $errors = [];
    /**
     * @var array
     */
    private $cleanedInput = [];

    public function validateInput(array $inputs)
    {
        // Foreach input, we check if not empty, we trim it and check its length
        foreach ($inputs as $type => $input) {
            if (!$input) {
                $this->errors[$type] = "This field cannot be empty";
            } else {
                switch ($type) {
                    case "password":
                        // Check length and hash
                        if (strlen($input) > 255) {
                            $this->errors[$type] = "This field cannot be more than 255 characters";
                        } else {
                            $input = $this->securePassword($input);
                        }
                        break;
                    case "email":
                        $input = trim($input);
                        // Check length
                        if (strlen($input) > 320) {
                            $this->errors[$type] = "This field cannot be more than 320 characters";
                        }
                        break;
                    default:
                        $input = trim($input);
                        // check default length
                        if (strlen($input) > 255) {
                            $this->errors[$type] = "This field cannot be more than 255 characters";
                        }
                        break;
                }
                // if no errors, clean input is stored in cleanedInput var
                $this->cleanedInput[$type] = $input;
            }
        }
        // If no errors, the function returns true, if errors, the function returns false
        // the controller then tests the return value of this function and decides what to do
        if (empty($this->errors)) {
            return true;
        } else {
            return false;
        }
    }

    // Function used to get the array filled with the errors returned
    public function getErrors()
    {
        return $this->errors;
    }

    // function used to get the array filled with the data trimmed by the validateInput function
    public function getCleanedInput()
    {
        return $this->cleanedInput;
    }

    // Test if two passwords givent are matching
    // returns true if they are matching, false if not and stores an error in the variable $errors
    public function matchingPasswords($password1, $password2)
    {
        if ($password1 !== $password2) {
            $errors = "Passwords should match";
             $this->errors['password'] = $errors;
        }
        if (empty($errors)) {
            return true;
        } else {
            return false;
        }
    }
    public function securePassword($password): string
    {
        return password_hash($password, PASSWORD_DEFAULT);
    }
}
