<?php 

class Game {
    private $title;
    private $steam_id;
    private $description;
    private $image;
    private $price;
    private $release_date;
    private $developer;
    private $publisher;
    private $conn;
    public function __construct() {
        $db = new Database();
        $this->conn = $db->getConnection();
    }
    public function getGameDetails() {
        $query = "SELECT * FROM games WHERE title = :title";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":title", $this->title);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function setTitle($title) {
        $this->title = $title;
    }
    public function getTitle() {
        return $this->title;
    }
    public function setSteamId($steam_id) {
        $this->steam_id = $steam_id;
    }

    public function getSteamId() {
        return $this->steam_id;
    }
    public function setDescription($description) {
        $this->description = $description;
    }
    public function getDescription() {
        return $this->description;
    }
    public function setImage($image) {
        $this->image = $image;
    }
    public function getImage() {
        return $this->image;
    }
    public function setPrice($price) {
        $this->price = $price;
    }
    public function getPrice() {
        return $this->price;
    }
    public function setReleaseDate($release_date) {
        $this->release_date = $release_date;
    }
    public function getReleaseDate() {
        return $this->release_date;
    }
    public function setDeveloper($developer) {
        $this->developer = $developer;
    }
    public function getDeveloper() {
        return $this->developer;
    }
    public function setPublisher($publisher) {
        $this->publisher = $publisher;
    }
    public function getPublisher() {
        return $this->publisher;
    }

    public function addGame($title, $steam_id, $description, $image, $price, $release_date, $developer, $publisher) {
        $query = "INSERT INTO games (title, steam_id, description, image, price, release_date, developer, publisher) VALUES (:title, :steam_id, :description, :image, :price, :release_date, :developer, :publisher)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":title", $title);
        $stmt->bindParam(":steam_id", $steam_id);
        $stmt->bindParam(":description", $description);
        $stmt->bindParam(":image", $image);
        $stmt->bindParam(":price", $price);
        $stmt->bindParam(":release_date", $release_date);
        $stmt->bindParam(":developer", $developer);
        $stmt->bindParam(":publisher", $publisher);
        $stmt->execute();
    }
    public function updateGame($title, $steam_id, $description, $image, $price, $release_date, $developer, $publisher) {
        $query = "UPDATE games SET title = :title, steam_id = :steam_id, description = :description, image = :image, price = :price, release_date = :release_date, developer = :developer, publisher = :publisher WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->bindParam(":title", $title);
        $stmt->bindParam(":steam_id", $steam_id);
        $stmt->bindParam(":description", $description);
        $stmt->bindParam(":image", $image);
        $stmt->bindParam(":price", $price);
        $stmt->bindParam(":release_date", $release_date);
        $stmt->bindParam(":developer", $developer);
        $stmt->bindParam(":publisher", $publisher);
        $stmt->execute();
    }
    public function deleteGame($title) {
        $query = "DELETE FROM games WHERE title = :title";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":title", $title);
        $stmt->execute();
    }
    public function getAllGames() {
        $query = "SELECT * FROM games";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}