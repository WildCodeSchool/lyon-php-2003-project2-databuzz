<?php


namespace App\Utils;

class FormValidator
{
    /**
     * @var string
     */
    private $errors = "";
    /**
     * @var string
     */
    private $cleanedInput = "";

    public function validateInput(string $input, array $constraints = ['required' => true, 'maxLength' => 255])
    {
        $errors = "";
        // Clean input
        $cleanedInput = trim($input);
        $this->cleanedInput = $cleanedInput;

        if ($constraints['required'] === true &&  !$cleanedInput) {
            $errors = "This field cannot be empty";
        } elseif (strlen($input) > $constraints['maxLength']) {
            $errors = "This field cannot be more than " . $constraints['maxLength'] . " characters";
        }

        $this->errors = $errors;

        if (empty($errors)) {
            return true;
        } else {
            return false;
        }
    }

    // Function used to get the array filled with the errors
    public function getErrors()
    {
        return $this->errors;
    }

    // function used to get the array filled with the trimmed data
    public function getCleanedInput()
    {
        return $this->cleanedInput;
    }

    public function matchingPasswords($password1, $password2)
    {
        if ($password1 !== $password2) {
            $errors = "Passwords should match";
             $this->errors = $errors;
        }
        if (empty($errors)) {
            return true;
        } else {
            return false;
        }
    }
}
