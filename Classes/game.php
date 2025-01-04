<?php

class Game
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function gameDetails()
    {
        // $query = "SELECT * FROM games WHERE title = :title";
        // $stmt = $this->pdo->prepare($query);
        // $stmt->bindParam(":title", $this->title);
        // $stmt->execute();
        // $info = $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function addGame()
    {
        try {
            $this->pdo->beginTransaction();
            $stmt = $this->pdo->prepare("INSERT INTO library (game_name, game_desc, game_img, release_date, category, developer, publisher) VALUES (:game_name, :game_desc, :game_img, :release_date, :category, :developer, :publisher)");
            $stmt->bindParam(":game_name", $_POST['Title']);
            $stmt->bindParam(":game_desc", $_POST['description']);
            $stmt->bindParam(":game_img", $_POST['image']);
            $stmt->bindParam(":category", $_POST['category']);
            $stmt->bindParam(":release_date", $_POST['release_date']);
            $stmt->bindParam(":developer", $_POST['developer']);
            $stmt->bindParam(":publisher", $_POST['publisher']);
            if (!$stmt->execute()) {
                throw new Exception("The game has not been added seccussfuly!!");
            }
            $additional_img = null;
            if (isset($_FILES['additional_img2']) && $_FILES['additional_img2']['error'] === UPLOAD_ERR_OK) {
                $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
                if (!in_array($_FILES['additional_img2']['type'], $allowedTypes)) {
                    throw new Exception("Invalid file type. Only JPEG, PNG, and GIF are allowed.");
                }

                $target_dir = "./../assests/";
                if (!is_dir($target_dir)) {
                    throw new Exception("Target directory does not exist.");
                }
                if (!is_writable($target_dir)) {
                    throw new Exception("Target directory is not writable.");
                }

                $file_extension = strtolower(pathinfo($_FILES['additional_img2']['name'], PATHINFO_EXTENSION));
                $unique_file_name = uniqid() . '.' . $file_extension;
                $additional_img = $target_dir . $unique_file_name;
                if (!move_uploaded_file($_FILES['additional_img2']['tmp_name'], $additional_img)) {
                    throw new Exception("Failed to upload the file.");
                }
            } else {
                throw new Exception("No file uploaded or an upload error occurred.");
            }
            $last_id = (int) $this->pdo->lastInsertId();

            $stmt = $this->pdo->prepare("INSERT INTO screenshots (game_id, url) VALUES (:game_id, :url1)");
            $stmt->bindParam(":game_id", $last_id);
            $stmt->bindParam(":url1", $_POST['additional_img']);
            if (!$stmt->execute()) {
                throw new Exception("An error appear with the images inserting try again.");
            }

            $stmt = $this->pdo->prepare("INSERT INTO screenshots (game_id, url) VALUES (:game_id, :url2)");
            $stmt->bindParam(":game_id", $last_id);
            $stmt->bindParam(":url2", $additional_img);
            if (!$stmt->execute()) {
                throw new Exception("An error appear with the images inserting try again.");
            }
            $this->pdo->commit();
        } catch (Exception $e) {
            $this->pdo->rollback();
            $errorMessage = $e->getMessage();
            header("Location: ./../pages/dashboard.php?error=" . urlencode($errorMessage));
            exit();
        }
    }

    // public function updateGame($title, $steam_id, $description, $image, $price, $release_date, $developer, $publisher) {
    //     $query = "UPDATE games SET title = :title, steam_id = :steam_id, description = :description, image = :image, price = :price, release_date = :release_date, developer = :developer, publisher = :publisher WHERE id = :id";
    //     $stmt = $this->conn->prepare($query);
    //     $stmt->bindParam(":id", $id);
    //     $stmt->bindParam(":title", $title);
    //     $stmt->bindParam(":steam_id", $steam_id);
    //     $stmt->bindParam(":description", $description);
    //     $stmt->bindParam(":image", $image);
    //     $stmt->bindParam(":price", $price);
    //     $stmt->bindParam(":release_date", $release_date);
    //     $stmt->bindParam(":developer", $developer);
    //     $stmt->bindParam(":publisher", $publisher);
    //     $stmt->execute();
    // }
    // public function deleteGame($title) {
    //     $query = "DELETE FROM games WHERE title = :title";
    //     $stmt = $this->conn->prepare($query);
    //     $stmt->bindParam(":title", $title);
    //     $stmt->execute();
    // }
    // public function getAllGames() {
    //     $query = "SELECT * FROM games";
    //     $stmt = $this->conn->prepare($query);
    //     $stmt->execute();
    //     return $stmt->fetchAll(PDO::FETCH_ASSOC);
    // }
}
