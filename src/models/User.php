<?php

namespace Models;

use Auth\Hash;
use Database\Database;

class User {
    public $id;
    public $username;
    private $password;
    public $lastFailAttempt;

    
    public static function has(string $username, string $pass): bool
    {
        $user = Database::select("select * from Users where username='{$username}'");
        if($user == null) {
            return false;
        }

        return Hash::verify($pass,$user['password']);
    }

    public static function hasUsername(string $username): bool
    {
        $user = Database::select("select * from Users where username='{$username}'");
        if($user == null) {
            return false;
        }
        return true;
    }

    public function create(string $username, string $password): bool
    {
        if(self::hasUsername($username)) {
            return false;
        }
        
        
    }
}
