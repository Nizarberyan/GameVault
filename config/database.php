<?php
class Database {
    private $conn;
    public function __construct() {
        $this->conn = new PDO("mysql:host=localhost;dbname=gamevault", "root", "");
    }
    public function getConnection() {
        return $this->conn;
    }
    public function insertUser($username, $email, $password) {
        $stmt = $this->conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
        $stmt->bindParam(1, $username);
        $stmt->bindParam(2, $email);
        $stmt->bindParam(3, $password);
        return $stmt->execute(); 
    }
    public function loginUser($email, $password) {
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->bindParam(1, $email);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            return $user['id'];
        } else {
            return false;
        }
    }
}
