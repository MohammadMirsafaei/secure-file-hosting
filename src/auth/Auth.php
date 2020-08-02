<?php

namespace Auth;

use Models\User;
/**
 * @property \Models\User $user
 */
class Auth {

    public static function authenticate(string $username, string $password): bool
    {
        if(User::has($username,$password)) {
            $_SESSION['uid'] = User::getID($username);
            return true;
        }
        return false;
    }

    public static function getAuthUser()
    {
        if(isset($_SESSION['uid'])) {
            return User::getUserById($_SESSION['uid']);
        } else {
            return null;
        }

    }

    public static function revoke()
    {
        unset($_SESSION['uid']);
    }
}