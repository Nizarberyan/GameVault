<?php

class Db
{
    private static $instance = null;
    private $pdo;

    private function __construct()
    {
        $servername = "localhost";
        $username = "root";
        $password = "analikayn";
        $dbname = "gamevault";

        $dsn = "mysql:host=$servername;dbname=$dbname";
        $options = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ];

        $this->pdo = new PDO($dsn, $username, $password, $options);
    }

    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance->pdo;
    }
}
