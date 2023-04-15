<?php

class Validate
{
    private $errors = [];


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

    // Check if the provided string is a valid phone number based on selected country
    public function isPhone(string $phoneNumber, string $country) : bool
    {
        switch ($country) {
            case 'EE':
                $pattern = '/^(\+372)?[58][0-9]{7}$/';
                break;
            case 'LV':
                $pattern = '/^(\+371)?2[0-9]{7}$/';
                break;
            case 'LT':
                $pattern = '/^(\+370)?[65][0-9]{7}$/';
                break;
            default:
                return FALSE;
        }

        return preg_match($pattern, $phoneNumber) === 1;
    }

    // Check if the provided string is a valid password
    // In case of any errors, call a function to register an error, return the array of errors, otherwise return FALSE
    public function isPassword(string $string)
    {
        if (strlen($string) < 8) {
            $this->error("length", ["min" => 8, "max" => 32]);
        }
        if (!$this->hasUppercase($string)) {
            $this->error("uppercase");
        }
        if (!$this->hasLowercase($string)) {
            $this->error("lowercase");
        }
        if (!$this->hasSpecialChar($string)) {
            $this->error("special");
        }

        return $this->errors ?? TRUE;
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

    public function error(string $restriction, array $parameters = []) : void
    {
        switch ($restriction) {
            case "length":
                $this->errors[$restriction] = "garumam jābūt starp " . $parameters["min"] . " un " . $parameters["max"] . " simboliem;";
                break;
            case "uppercase":
                $this->errors[$restriction] = "jāsatur vismaz viens lielais burts;";
                break;
            case "lowercase":
                $this->errors[$restriction] = "jāsatur vismaz viens mazais burts;";
                break;
            case "special":
                $this->errors[$restriction] = "jāsatur vismaz viens speciālais simbols;";
                break;
            default:
                $this->errors[$restriction] = "nedefinēta kļūda: {$restriction};";
        }
    }

}