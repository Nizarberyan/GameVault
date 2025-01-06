<?php
class Database {
    private $conn;
    public function __construct() {
        $this->conn = new PDO("mysql:host=localhost;dbname=gamevault", "root", "");
    }
    public function getConnection() {
        return $this->conn;
    }
    
}
