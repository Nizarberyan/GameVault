<?php
require_once __DIR__ . "../../controllers/gameController.php";
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
            return $info = $stmt->fetchAll();
        } else {
            throw new Exception("Something went wrong");
        }
    }

    public function gameDetails($game_id)
    {
        try {
            $this->pdo->beginTransaction();

            $game_info = $this->pdo->prepare("SELECT * FROM library WHERE game_id = ?");
            if (!$game_info->execute([$game_id])) throw new Exception("Something went wrong");

            $screenshots = $this->pdo->prepare("SELECT url FROM screenshots WHERE game_id = ?");
            if (!$screenshots->execute([$game_id])) throw new Exception("Something went wrong");
            $urls = $screenshots->fetchAll();
            $updatedRows = [];
            foreach ($urls as $index => $url) {
                $updatedRows[] = [
                    "url_" . ($index + 1) => $url['url'],
                ];
            }

            $reviews = $this->pdo->prepare("SELECT review_desc, full_name, rating_review FROM reviews JOIN users ON users.user_id = reviews.user_id WHERE reviews.game_id = ?;");
            if (!$reviews->execute([$game_id])) throw new Exception("Something went wrong");
            $reviews_data = $reviews->fetchAll();

            $messages = $this->pdo->prepare("SELECT message, full_name FROM live_chat JOIN users ON users.user_id = live_chat.user_id WHERE live_chat.game_id = ? ORDER BY live_chat.created_at ASC;");
            if (!$messages->execute([$game_id])) throw new Exception("Something went wrong");
            $chat_data = $messages->fetchAll();

            $total_points = $this->pdo->prepare("SELECT SUM(rating_value) AS totalPoints, COUNT(review_desc) AS divisor FROM reviews;");
            if (!$total_points->execute()) throw new Exception("Something went wrong");
            $ratings_data = $total_points->fetch();

            $info = array_merge($game_info->fetch(), $updatedRows[0], $updatedRows[1], $ratings_data);
            $info['reviews'] = $reviews_data;
            $info['chat_data'] = $chat_data;
            // var_dump($info);
            // die();
            $this->pdo->commit();
            return $info;
        } catch (Exception $e) {
            $this->pdo->rollback();
            throw new Exception($e);
        }
    }

    public function addGame($target_dir, $additional_img, $controller)
    {
        try {
            $this->pdo->beginTransaction();
            $insert = $this->pdo->prepare("INSERT INTO library (game_name, game_desc, game_img, release_date, category, developer, publisher, rating) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
            $insert->bindParam(1, $_POST['Title']);
            $insert->bindParam(2, $_POST['description']);
            $insert->bindParam(3, $_POST['image']);
            $insert->bindParam(4, $_POST['release_date']);
            $insert->bindParam(5, $_POST['category']);
            $insert->bindParam(6, $_POST['developer']);
            $insert->bindParam(7, $_POST['publisher']);
            $insert->bindParam(8, $_POST['rating']);
            if (!$insert->execute()) {
                throw new Exception("The game has not been added successfully!!");
            }

            $last_id = (int) $this->pdo->lastInsertId();

            $firstUrl = $this->pdo->prepare("INSERT INTO screenshots (game_id, url, row_id) VALUES (?, ?, 1);");
            $firstUrl->bindParam(1, $last_id);
            $firstUrl->bindParam(2, $_POST['additional_img']);
            if (!$firstUrl->execute()) {
                throw new Exception("An error occurred with the first image insertion.");
            }

            $secondUrl = $this->pdo->prepare("INSERT INTO screenshots (game_id, url, row_id) VALUES (?, ?, 2);");
            $secondUrl->bindParam(1, $last_id);
            $secondUrl->bindParam(2, $additional_img);
            if (!$secondUrl->execute()) {
                throw new Exception("An error occurred with the second image insertion.");
            }

            // Log the action of adding a new game
            $user_id = $_SESSION['user_id'];
            $action = "Added new game: " . $_POST['Title'];

            // Use the passed controller instance to log the action
            $controller->logAction($user_id, $action, $last_id);

            $this->pdo->commit();
        } catch (Exception $e) {
            $this->pdo->rollback();
            $_SESSION['Error'] = true;
            $_SESSION['Message'] = $e->getMessage();
            header("Location: ./../pages/dashboard.php");
            exit();
        }
    }

    public function updateGame($target_dir, $additional_img)
    {
        try {
            $this->pdo->beginTransaction();
            $mainInfo = $this->pdo->prepare("UPDATE library SET game_name = ?, game_desc = ?, game_img = ?, rating = ?, release_date = ?, developer = ?, publisher = ?, category = ? WHERE game_id = ?");
            if (!$mainInfo->execute([
                $_POST['Title'],
                $_POST['description'],
                $_POST['image'],
                $_POST['rating'],
                $_POST['release_date'],
                $_POST['developer'],
                $_POST['publisher'],
                $_POST['category'],
                $_POST['game_id']
            ])) throw new Exception("The game has not been added successfully!");

            $additional_imgs = $this->pdo->prepare("UPDATE screenshots
                                        SET url = CASE
                                            WHEN game_id = ? AND row_id = 1 THEN ?
                                            WHEN game_id = ? AND row_id = 2 THEN ?
                                            ELSE url
                                        END
                                        WHERE game_id = ? AND row_id IN (1, 2);");

            if (!$additional_imgs->execute([$_POST['game_id'], $_POST['additional_img1'], $_POST['game_id'], $_POST['additional_img2'], $_POST['game_id']])) {
                throw new Exception("An error appeared with the images insertion. Please try again.");
            }

            $this->pdo->commit();
        } catch (Exception $e) {
            $this->pdo->rollback();
            $_SESSION['Error'] = true;
            $_SESSION['Message'] = $e->getMessage();
            header("Location: ./../controllers/gameController.php?action=ER");
            exit();
        }
    }
    public function deleteGame($game_id)
    {
        $stmt = $this->pdo->prepare("DELETE FROM library WHERE game_id = ?;");
        if (!$stmt->execute([$game_id])) {
            throw new Exception("The game has not been deleted successfuly!!");
        }
    }

    public function editSession($game_id)
    {
        $info = $this->pdo->prepare("SELECT * FROM library WHERE game_id = ?;");
        $info->bindParam(1, $game_id);
        if (!$info->execute()) throw new Exception("Something went wrong");
        $info = $info->fetch();
        extract($info);

        $additional_data = $this->pdo->prepare("SELECT url FROM screenshots WHERE game_id = ?;");
        $additional_data->bindParam(1, $game_id);
        if (!$additional_data->execute()) throw new Exception("Something went wrong");
        $additional_data = $additional_data->fetchAll();
        extract($additional_data[0], EXTR_PREFIX_ALL, "r1");
        extract($additional_data[1], EXTR_PREFIX_ALL, "r2");
        include("./../pages/gameEdit.php");
    }

    public function reviewSubmit($game_id, $user_id)
    {
        $review_submit = $this->pdo->prepare("INSERT INTO reviews (game_id, user_id, review_desc, rating_review, rating_value) VALUES(?, ?, ?, ?, ?);");
        if (!$review_submit->execute([
            $game_id,
            $user_id,
            $_POST["comment"],
            $_POST["rating"],
            $_POST["rating_value"]
        ])) throw new Exception("Something went wrong!!");
    }
}
