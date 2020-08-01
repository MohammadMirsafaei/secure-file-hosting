<?php

namespace App;

use Exception;

class RouteNotFoundException extends Exception
{
    public function errorMessage() : string
    {
        return 'Not a valid Route';
    }
}