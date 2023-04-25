<?php

class Validate
{
    private $errors = [];


    // Check if the provided variable's value is empty
    public function isEmpty(string $field, mixed $value): bool
    {
        if (empty($value)) {
            $this->addError($field, "empty");
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

    public function hasSpecialChar(string $field, string $string) : bool
    {
        if (preg_match('/[!@#$%^&*(),.?":{}|<>]/', $string)) {
            return TRUE;
        } else {
            $this->addError($field, "specialChar");
            return FALSE;
        }
    }

    public function hasNoSpecialChar(string $field, string $string) : bool
    {
        if (!preg_match('/[!@#$%^&*(),.?":{}|<>]/', $string)) {
            return TRUE;
        } else {
            $this->addError($field, "noSpecialChar");
            return FALSE;
        }
    }

    public function hasNoNumbers(string $field, string $string) : bool
    {
        if(!preg_match('/[0-9]/', $string)) {
            return TRUE;
        } else {
            $this->addError($field, "noNumbers");
            return FALSE;
        }
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

    public function isImage(string $string)
    {
        if (str_starts_with($string, "image")) {
            return TRUE;
        } else {
            $this->addError("Foto", "image");
            return FALSE;
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

    public function addError(string $field, string $restriction, array $parameters = []) : void
    {
        $errorString = "lauks \"{$field}\": ";
        switch ($restriction) {
            case "length":
                if ($parameters) {
                    $errorString .= "jābūt garumā no {$parameters['min']} līdz {$parameters['max']} simboliem;";
                } else {
                    $errorString .= "neatbilstošs garums;";
                }
                break;
            case "fullUppercase":
                $errorString .= "jābūt tikai lielajiem burtiem;";
                break;
            case "uppercase":
                $errorString .= "jāsatur vismaz viens lielais burts;";
                break;
            case "fullLowercase":
                $errorString .= "jābūt tikai mazajiem burtiem;";
                break;
            case "lowercase":
                $errorString .= "jāsatur vismaz viens mazais burts;";
                break;
            case "specialChar":
                $errorString .= "jāsatur vismaz viens speciālais simbols;";
                break;
            case "noSpecialChar":
                $errorString .= "nedrīkst saturēt speciālos simbolus;";
                break;
            case "noNumbers":
                $errorString .= "nedrīkst saturēt ciparus;";
                break;
            case "image":
                $errorString .= "jābūt attēlam;";
                break;
            case "empty":
                $errorString .= "nedrīkst būt tukšs;";
                break;
            default:
                $errorString .= "nedefinēta kļūda: {$restriction};";
        }
        $this->errors[] = $errorString;
    }

    public function getErrors() : array
    {
        return $this->errors;
    }

    public function redirect(string $pageName, string $errorType, string $errorField = '') : void
    {
        if($errorField) {
            header("Location: " . PUBLIC_DIR . "/{$pageName}.php?error={$errorType}&field={$errorField}");
        } else {
            header("Location: " . PUBLIC_DIR . "/{$pageName}.php?error={$errorType}");
        }
        exit();
    }

}