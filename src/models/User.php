<?php

namespace Models;

use Auth\Hash;
use Database\Database;

class User {
    public $id;
    public $username;
    private $password;
    public $lastFailAttempt;
    public $integLevel;
    public $confLevel;

    
    public static function has(string $username, string $pass): bool
    {
        $user = Database::select("select * from Users where username='{$username}'")[0];
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

    public static function create(string $username, string $password): bool
    {
        if(self::hasUsername($username)) {
            return false;
        }
        Database::command("insert into Users(username,password) values (:username, :password)",
                            [
                                'username' => $username,
                                'password' => Hash::make($password)
                            ]);
        return true;
    }

    public static function getID(string $username): int
    {
        $user = Database::select("select * from Users where username='{$username}'")[0];
        return $user['id'];
    }

    public static function getUserById(int $id)
    {
        $user = Database::select("select * from Users where id={$id}")[0];
        $ret = new User();
        $ret->username = $user['username'];
        $ret->password = $user['password'];
        $ret->id = $user['id'];
        return $ret;
    }
}
