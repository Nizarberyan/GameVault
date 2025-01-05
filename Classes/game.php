<?php

class Game
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function gamesRenderer()
    {
        $stmt = $this->pdo->prepare("SELECT * FROM library");
        if ($stmt->execute()) {
            $info = $stmt->fetchAll(PDO::FETCH_ASSOC);
            include("./../pages/gamesList.php");
        } else {
            throw new Exception("Something went wrong");
        }
    }

    public function addGame($target_dir)
    {
        try {
            $this->pdo->beginTransaction();
            $insert = $this->pdo->prepare("INSERT INTO library (game_name, game_desc, game_img, release_date, category, developer, publisher, rating) VALUES (:game_name, :game_desc, :game_img, :release_date, :category, :developer, :publisher, :rating)");
            $insert->bindParam(":game_name", $_POST['Title']);
            $insert->bindParam(":game_desc", $_POST['description']);
            $insert->bindParam(":game_img", $_POST['image']);
            $insert->bindParam(":category", $_POST['category']);
            $insert->bindParam(":release_date", $_POST['release_date']);
            $insert->bindParam(":developer", $_POST['developer']);
            $insert->bindParam(":publisher", $_POST['publisher']);
            $insert->bindParam(":rating", $_POST['rating']);
            if (!$insert->execute()) {
                throw new Exception("The game has not been added seccussfuly!!");
            }
            
            $additional_img = null;
            $file_extension = strtolower(pathinfo($_FILES['additional_img2']['name'], PATHINFO_EXTENSION));
            $unique_file_name = uniqid() . '.' . $file_extension;
            $additional_img = $target_dir . $unique_file_name;
            if (!move_uploaded_file($_FILES['additional_img2']['tmp_name'], $additional_img)) {
                throw new Exception("Failed to upload the file.");
            }

            $last_id = (int) $this->pdo->lastInsertId();
            $firstUrl = $this->pdo->prepare("INSERT INTO screenshots (game_id, url) VALUES (:game_id, :url1)");
            $firstUrl->bindParam(":game_id", $last_id);
            $firstUrl->bindParam(":url1", $_POST['additional_img']);
            if (!$firstUrl->execute()) {
                throw new Exception("An error appear with the images inserting try again.");
            }
            $secondUrl = $this->pdo->prepare("INSERT INTO screenshots (game_id, url) VALUES (:game_id, :url2)");
            $secondUrl->bindParam(":game_id", $last_id);
            $secondUrl->bindParam(":url2", $additional_img);
            if (!$secondUrl->execute()) {
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
    //     $stmt->bindParam(":release_date", $release_date);
    //     $stmt->bindParam(":developer", $developer);
    //     $stmt->bindParam(":publisher", $publisher);
    //     $stmt->execute();
    // }
    public function deleteGame($id)
    {
        $stmt = $this->pdo->prepare("DELETE FROM library WHERE game_id = :game_id");
        $stmt->bindParam(":game_id", $id);
        if (!$stmt->execute()) {
            throw new Exception("The game has not been deleted successfuly!!");
        }
    }
}
