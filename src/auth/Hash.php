<?php

namespace Auth;

class Hash {
    public static function make(string $val): string
    {
        return password_hash($val,PASSWORD_DEFAULT,['cost'=>10]);
    }

    public static function verify(string $pass, string $hash): bool
    {
        return password_verify($pass,$hash);
    } 
}