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
        // Clean input of spaces before and after and store it in variable
        $cleanedInput = trim($input);
        $this->cleanedInput = $cleanedInput;

        // if input is required (true by default), and $cleanedImput empty, add an error
        // then if length of input superior to VARCHAR length in database, add an error
        // by default, VARCHAR 255, should be modified in the $constraints table when necessary
        if ($constraints['required'] === true &&  !$cleanedInput) {
            $errors = "This field cannot be empty";
        } elseif (strlen($input) > $constraints['maxLength']) {
            $errors = "This field cannot be more than " . $constraints['maxLength'] . " characters";
        }

        // Store the errors given by the function in the variable
        $this->errors = $errors;

        // If no errors, the function returns true, if errors, the function returns false
        // the controller then tests the return value of this function and decides what to do
        if (empty($errors)) {
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
             $this->errors = $errors;
        }
        if (empty($errors)) {
            return true;
        } else {
            return false;
        }
    }
}
