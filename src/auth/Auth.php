<?php

namespace Auth;

use Models\User;
/**
 * @property \Models\User $user
 */
class Auth {
    public static $user;

    public static function authenticate(string $username, string $password): bool
    {
        if(User::has($username,$password)) {
            return true;
        }
        return false;
    }
}