<?php

namespace Auth;

use Logger\Logger;
use Models\User;
/**
 * @property \Models\User $user
 */
class Auth {

    public static function authenticate(string $username, string $password): bool
    {
        if(User::has($username,$password)) {
            if(User::getUserByUsername($username)->active) {
                $_SESSION['uid'] = User::getID($username);
                return true;
            }
            Logger::log("user {$username} tried to log in but account was diactive");
            return false;
        }
        Logger::log("fail attempt for user {$username}");
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