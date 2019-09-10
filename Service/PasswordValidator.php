<?php
namespace Service;

class PasswordValidator {
    
    protected $password;
    
    private $errors = [];

    function __construct($password) {
        $this->password = $password;
    }

    /**
     * run validations
     * @return void
     */
    public function valid() {

        if($this->validLengthChar(8)) {
            $this->errors[] = 'Minimum of 8 characters';
        }
        if($this->shouldAlphanumericValid()) {
            $this->errors[] = 'Alphanumeric (a combination of letters and numbers)';
        }
        if($this->shouldOneCapitalLetter()) {
            $this->errors[] = 'There needs to be al least one capital letter';
        }
        if($this->shouldEspecialChar()) {
            $this->errors[] = 'The use of special characters (@, #, $) is mandatory';
        }
    }

    /**
     * Get Errors
     * @return array
     */
    public function getErrors() {
        return $this->errors;
    }

    /**
     * Valid char length
     * @param $n integer
     * @return boolean
     */
    public function validLengthChar($n) {
        return strlen($this->password) < $n;
    }

    /**
     * Valid char alphanumeric
     * @return boolean
     */
    public function shouldAlphanumericValid() {
        $error = false;
        if(preg_match("#^[0-9]*$#", $this->password)) {
            $error = true;
        }else if(preg_match("#^[a-z]*$#", $this->password)) {
            $error = true;
        }else if(preg_match("#^[0-9a-z]*$#", $this->password)) {
            $error = false;
        }
        return $error;
    }

    /**
     * Valid One Capital letter
     * @return boolean
     */
    public function shouldOneCapitalLetter() {
        return !preg_match('#[A-Z]#', $this->password);
    }

    /**
     * Valid Especial char
     * @return boolean
     */
    public function shouldEspecialChar() {
        return !preg_match('/[@#$]/', $this->password);
    }
}