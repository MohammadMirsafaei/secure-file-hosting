<?php

namespace App;

use Exception;

class BadMethodException extends Exception
{
    public function errorMessage() : string
    {
        return 'Not a valid method';
    }
}