<?php

class Validate
{
    // Check if the provided variable's value is empty
    public function isEmpty(mixed $value): bool
    {
        if (empty($value)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    // Check if the provided string is all lowercase
    public function isFullLowercase(string $string): bool
    {
        if ($string === strtolower($string)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    // Check if the provided string is all uppercase
    public function isFullUppercase(string $string) : bool
    {
        if ($string === strtoupper($string)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function hasUppercase(string $string) : bool
    {
        return preg_match('/[A-Z]/', $string) === 1;
    }

    public function hasLowercase(string $string) : bool
    {
        return preg_match('/[a-z]/', $string) === 1;
    }

    public function hasSpace(string $string) : bool
    {
        return preg_match('/\s/', $string) === 1;
    }

    public function hasSpecialChar(string $string) : bool
    {
        return preg_match('/[!@#$%^&*(),.?":{}|<>]/', $string) === 1;
    }

    // Check if the provided string is a valid email address
    public function isEmail(string $string) : bool
    {
        return filter_var($string, FILTER_VALIDATE_EMAIL);
    }

    // Check if the provided string is a valid password
    public function isPassword(string $string) : bool
    {
        if (strlen($string) < 8) {
            return FALSE;
        } else if (!$this->hasUppercase($string)) {
            return FALSE;
        } else if (!$this->hasLowercase($string)) {
            return FALSE;
        } else if (!$this->hasSpecialChar($string)) {
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function cleanInput(string $string) : string
    {
        // Trim function removes whitespace from beginning and end of string
        $string = trim($string);
        // Stripslashes function removes backslashes from string
        $string = stripslashes($string);
        // Htmlspecialchars function converts special characters to HTML entities
        $string = htmlspecialchars($string);
        return $string;
    }

}