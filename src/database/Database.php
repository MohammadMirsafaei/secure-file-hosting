<?php

namespace Database;

use PDO;
use PDOStatement;


class Database {
    public static $server = "localhost";
    public static $database = "sfh";
    public static $username = "root";
    public static $password = "1234";

    public static $connection;

    private static function connect() 
    {
        try {
            self::$connection = new PDO("mysql:host=".self::$server.";dbname=".self::$database, self::$username, self::$password);
            self::$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
        } catch (\PDOException $e) {
            echo "Connection faild : " . $e->getMessage();
        }
    }

    private static function close()
    {
        self::$connection = null;
    }

    public static function select(string $query): array
    {
        self::connect();
        $stmt = self::$connection->prepare($query);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $result = $stmt->fetchAll();
        self::close();
        return $result;
    }

    public function insert(string $query,string $types,...$el): bool
    {
        self::connect();
        $stmt = self::$connection->prepare($query);
        $stmt->bind_param("");
        $stmt->execute();
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        self::close();
        return true;
    }
    

}