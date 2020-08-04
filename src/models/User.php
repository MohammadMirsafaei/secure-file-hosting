<?php

namespace Models;

use Auth\Hash;
use Database\Database;

class User {
    public $id;
    public $username;
    private $password;
    public $lastFailCount;
    public $integLevel;
    public $confLevel;
    public $active;
    
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

    public static function create(string $username, string $password, string $integLevel, string $confLevel): bool
    {
        if(self::hasUsername($username)) {
            return false;
        }
        Database::command("insert into Users(username,password,integlevel,conflevel) values (:username, :password, :integLevel, :confLevel)",
                            [
                                'username' => $username,
                                'password' => Hash::make($password),
                                'integLevel' => $integLevel,
                                'confLevel' => $confLevel
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
        $ret->integLevel = $user['integlevel'];
        $ret->confLevel = $user['conflevel'];
        $ret->id = $user['id'];
        $ret->active = $user['active'];
        $ret->lastFailCount = $user['lastfailcount'];
        return $ret;
    }

    public static function getUserByUsername(string $username)
    {
        $user = Database::select("select * from Users where username='{$username}'")[0];
        $ret = new User();
        $ret->username = $user['username'];
        $ret->password = $user['password'];
        $ret->integLevel = $user['integlevel'];
        $ret->confLevel = $user['conflevel'];
        $ret->id = $user['id'];
        $ret->active = $user['active'];
        $ret->lastFailCount = $user['lastfailcount'];
        return $ret;
    }

    public function update() 
    {
        Database::command("update Users set lastfailcount=:lfc,active=:active where id=:id",[
            'lfc' => $this->lastFailCount,
            'id' => $this->id,
            'active' => $this->active
        ]);
    }

    public function updatePassword(string $password) 
    {
        
    }
}
