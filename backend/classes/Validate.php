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

    // Check if the provided string is correct length
    public function isLength(string $field, string $string, int $min, int $max): bool
    {
        if (strlen($string) >= $min && strlen($string) <= $max) {
            return TRUE;
        } else {
            $this->addError($field, "length", ["min" => $min, "max" => $max]);
            return FALSE;
        }
    }

    // Check if the provided string is all lowercase
    public function isFullLowercase(string $field, string $string): bool
    {
        if ($string === strtolower($string)) {
            return TRUE;
        } else {
            $this->addError($field, "fullLowercase");
            return FALSE;
        }
    }

    // Check if the provided string is all uppercase
    public function isFullUppercase(string $field, string $string) : bool
    {
        if ($string === strtoupper($string)) {
            return TRUE;
        } else {
            $this->addError($field, "fullUppercase");
            return FALSE;
        }
    }

    public function hasUppercase(string $field, string $string) : bool
    {
        if (preg_match('/[A-Z]/', $string)) {
            return TRUE;
        } else {
            $this->addError($field, "uppercase");
            return FALSE;
        }
    }

    public function hasLowercase(string $field, string $string) : bool
    {
        if (preg_match('/[a-z]/', $string)) {
            return TRUE;
        } else {
            $this->addError($field, "lowercase");
            return FALSE;
        }
    }

    public function hasNoSpace(string $field, string $string) : bool
    {
        if (!preg_match('/\s/', $string)) {
            return TRUE;
        } else {
            $this->addError($field, "space");
            return FALSE;
        }
    }

    public function hasSpecialChar(string $string) : bool
    {
        return preg_match('/[!@#$%^&*(),.?":{}|<>]/', $string);
    }

    // Check if the provided string is a valid email address
    public function isEmail(string $string) : bool
    {
        if (filter_var($string, FILTER_VALIDATE_EMAIL)) {
            return TRUE;
        } else {
            $this->addError("<strong>E-pasts:</strong>", "email");
            return FALSE;
        }
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
        $field = "Parole";
        $this->isLength($field, $string, 8, 32);
        $this->hasUppercase($field, $string);
        $this->hasLowercase($field, $string);
        $this->hasSpecialChar($field, $string);

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

    public function addError(string $field, string $restriction, array $parameters = []) : void
    {
        $this->errors[$restriction] = "<strong>{$field}</strong>: ";
        switch ($restriction) {
            case "length":
                if ($parameters) {
                    $this->errors[$restriction] .= "jābūt garumā no {$parameters['min']} līdz {$parameters['max']} simboliem;";
                } else {
                    $this->errors[$restriction] .= "neatbilstošs garums;";
                }
                break;
            case "fullUppercase":
                $this->errors[$restriction] .= "jābūt tikai lielajiem burtiem;";
                break;
            case "uppercase":
                $this->errors[$restriction] .= "jāsatur vismaz viens lielais burts;";
                break;
            case "fullLowercase":
                $this->errors[$restriction] .= "jābūt tikai mazajiem burtiem;";
                break;
            case "lowercase":
                $this->errors[$restriction] .= "jāsatur vismaz viens mazais burts;";
                break;
            case "special":
                $this->errors[$restriction] .= "jāsatur vismaz viens speciālais simbols;";
                break;
            default:
                $this->errors[$restriction] .= "nedefinēta kļūda: {$restriction};";
        }
    }

}