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

}