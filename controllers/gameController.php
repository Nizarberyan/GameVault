<?php
if (session_status() === PHP_SESSION_NONE) session_start();
spl_autoload_register(function ($class) {
    require_once "./../classes/" . $class . ".php";
});
require_once("./../config/Db.php");
// require_once("./../classes/Game.php");

class gameController
{
    private $pdo;
    private $action;

    public function __construct()
    {
        $this->pdo = Db::getInstance();
    }

    public function request_handler()
    {
        $this->action = $_GET['action'];

        switch ($this->action) {
            case "gCreate":
                $this->gameAdd();
                break;

            case "ER":
                $this->gameRenderForER();
                break;

            case "deleteGame":
                $this->deleteGame();
                break;

            case "editSession":
                $this->editSession();
                break;

            case "updateGame":
                $this->updateGame();
                break;

            case "home":
                $this->homeRendering();
                break;

            case "gameDetails":
                $this->gameDetails();
                break;
            case "reviewSubmit":
                $this->reviewSubmit();
                break;
            case "addToLibrary":
                $this->addToLibrary();
                break;

            case "viewLibrary":
                $this->viewLibrary();
                break;

            case "removeFromLibrary":
                $this->removeFromLibrary();
                break;

            case "viewLogs":
                $this->viewLogs();
                break;
        }
    }

    private function validation()
    {
        if (empty($_POST['Title'])) {
            throw new Exception("The title is required.");
        } elseif (!preg_match('/^[a-zA-Z0-9\s\-\_\,\.\'\"\!\?\(\)]+$/', $_POST['Title'])) {
            throw new Exception("Invalid title format. Only letters, numbers, spaces, and basic punctuation are allowed.");
        }

        if (empty($_POST['description'])) {
            throw new Exception("The description is required.");
        } elseif (!preg_match('/^[a-zA-Z0-9\s\-\_\,\.\'\"\!\?\n\r\(\)]+$/', $_POST['description'])) {
            throw new Exception("Invalid description format. Only letters, numbers, spaces, and basic punctuation are allowed.");
        }

        if (empty($_POST['category'])) {
            throw new Exception("The category is required.");
        }

        if (empty($_POST['developer'])) {
            throw new Exception("The developer is required.");
        } elseif (!preg_match('/^[a-zA-Z0-9\s\-\_\,\.\']+$/', $_POST['developer'])) {
            throw new Exception("Invalid developer format. Only letters, numbers, spaces, and basic punctuation are allowed.");
        }

        if (empty($_POST['publisher'])) {
            throw new Exception("The publisher is required.");
        } elseif (!preg_match('/^[a-zA-Z0-9\s\-\_\,\.\']+$/', $_POST['publisher'])) {
            throw new Exception("Invalid publisher format. Only letters, numbers, spaces, and basic punctuation are allowed.");
        }

        if (!isset($_POST['rating']) || $_POST['rating'] === '') {
            throw new Exception("The rating is required.");
        } elseif (!preg_match('/^(100|[0-9]{1,2})$/', $_POST['rating'])) {
            throw new Exception("The rating must be a number between 0 and 100.");
        }

        $imageFields = ['additional_img', 'image'];
        foreach ($imageFields as $field) {
            if (empty($_POST[$field])) {
                throw new Exception("The $field is required.");
            } elseif (!preg_match('/\b((http|https):\/\/)[a-z0-9.-]+(\.[a-z]{2,})?(:\d+)?(\/[^\s]*)?\b/i', $_POST[$field])) {
                throw new Exception("Invalid URL format for $field.");
            }
        }
    }

    private function gameAdd()
    {
        $path = "./../pages/dashboard.php";
        try {
            $newGame = new Game($this->pdo);
            $this->validation();
            if (!isset($_FILES['additional_img2']) && $_FILES['additional_img2']['error'] === UPLOAD_ERR_OK) {
                throw new Exception("No file uploaded or an upload error occurred.");
            }
            $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
            if (!in_array($_FILES['additional_img2']['type'], $allowedTypes)) {
                throw new Exception("Invalid file type. Only JPEG, PNG, and GIF are allowed.");
            }
            $target_dir = "./../assets/";
            if (!is_dir($target_dir)) {
                throw new Exception("Target directory does not exist.");
            }
            if (!is_writable($target_dir)) {
                throw new Exception("Target directory is not writable.");
            }

            $additional_img = null;
            $file_extension = strtolower(pathinfo($_FILES['additional_img2']['name'], PATHINFO_EXTENSION));
            $unique_file_name = uniqid() . '.' . $file_extension;
            $additional_img = $target_dir . $unique_file_name;
            if (!move_uploaded_file($_FILES['additional_img2']['tmp_name'], $additional_img)) {
                throw new Exception("Failed to upload the file.");
            }

            $newGame->addGame($target_dir, $additional_img, new gameController);
            $successMessage = "Game has been Added successfully!!";
            $this->redirect("Success", $successMessage, $path);
        } catch (Exception $e) {
            $errorMessage = $e->getMessage();
            $this->redirect("Error", $errorMessage, $path);
            exit();
        }
    }

    private function redirect($var, $message, $path)
    {
        $_SESSION[$var] = true;
        $_SESSION['Message'] = $message;
        header("Location: $path");
    }

    private function gameRenderForER()
    {
        $path = "./../pages/dashboard.php";
        try {
            $newGame = new Game($this->pdo);
            $info = $newGame->gamesRenderer();
            include("./../pages/gamesList.php");
        } catch (Exception $e) {
            $errorMessage = $e->getMessage();
            $this->redirect("Error", $errorMessage, $path);
            exit();
        }
    }

    private function deleteGame()
    {
        $path = "./../controllers/gameController.php?action=ER";
        try {
            if (!isset($_POST["game_id"])) {
                throw new Exception("Something went wrong. try again");
            }
            $newGame = new Game($this->pdo);
            $newGame->deleteGame((int)$_POST["game_id"]);
            $successMessage = "Game has been deleted successfully!!";
            $this->redirect("Success", $successMessage, $path);
        } catch (Exception $e) {
            $errorMessage = $e->getMessage();
            $this->redirect("Error", $errorMessage, $path);
            exit();
        }
    }

    private function editSession()
    {
        $editSession = new Game($this->pdo);
        $editSession->editSession($_GET["game_id"]);
    }

    private function updateGame()
    {
        $path = "./../controllers/gameController.php?action=ER";
        try {
            $this->validation();
            $target_dir = "./../assets/";
            if (!is_dir($target_dir)) {
                throw new Exception("Target directory does not exist.");
            }
            if (!is_writable($target_dir)) {
                throw new Exception("Target directory is not writable.");
            }

            $additional_img = null;
            if (isset($_FILES['additional_img2']) && $_FILES['additional_img2']['error'] !== UPLOAD_ERR_OK) {
                $file_extension = strtolower(pathinfo($_FILES['additional_img2']['name'], PATHINFO_EXTENSION));
                $unique_file_name = uniqid() . '.' . $file_extension;
                $additional_img = $target_dir . $unique_file_name;
                if (!move_uploaded_file($_FILES['additional_img2']['tmp_name'], $additional_img)) {
                    throw new Exception("Failed to upload the file.");
                }
            } else {
                $additional_img = $_POST['old_Url'];
            }


            $newGame = new Game($this->pdo);
            $newGame->updateGame($target_dir, $additional_img);
            $successMessage = "Game has been updated successfully!!";
            $this->redirect("Success", $successMessage, $path);
        } catch (Exception $e) {
            $errorMessage = $e->getMessage();
            $this->redirect("Error", $errorMessage, $path);
            exit();
        }
    }

    private function homeRendering()
    {


        $path = "./../pages/home.php";
        try {
            $games = new Game($this->pdo);
            $info = $games->gamesRenderer();
            include $path;
        } catch (Exception $e) {
            $errorMessage = $e->getMessage();
            $this->redirect("Error", $errorMessage, $path);
            exit();
        }
    }

    private function gameDetails()
    {
        $path = "./../pages/gameDetails.php";
        try {
            $games = new Game($this->pdo);
            $info = $games->gameDetails($_GET['id']);
            extract($info);
            include $path;
        } catch (Exception $e) {
            $errorMessage = $e->getMessage();
            $this->redirect("Error", $errorMessage, $path);
            exit();
        }
    }

    private function reviewSubmit()
    {
        $path = "./../controllers/gameController.php?action=gameDetails&id={$_POST['game_id']}";
        try {
            $games = new Game($this->pdo);
            $user_id = (int) $_SESSION['user_id'];
            $info = $games->reviewSubmit($_POST['game_id'], $user_id);
            $successMessage = "Review has been published successfully!!";
            $this->redirect("Success", $successMessage, $path);
        } catch (Exception $e) {
            $errorMessage = $e->getMessage();
            $this->redirect("Error", $errorMessage, $path);
            exit();
        }
    }

    private function addToLibrary()
    {
        $path = "./../controllers/gameController.php?action=home";
        try {
            if (!isset($_SESSION['user_id'])) {
                throw new Exception("You must be logged in to add a game to your library.");
            }

            $user_id = $_SESSION['user_id'];
            $game_id = $_POST['game_id'];

            $stmt = $this->pdo->prepare("INSERT INTO user_library (user_id, game_id) VALUES (?, ?)");
            if (!$stmt->execute([$user_id, $game_id])) {
                throw new Exception("Failed to add the game to your library.");
            }
            $this->logAction($user_id, "Added to library", $game_id);

            $successMessage = "Game added to your library successfully!";
            $this->redirect("Success", $successMessage, $path);
        } catch (Exception $e) {
            $errorMessage = $e->getMessage();
            $this->redirect("Error", $errorMessage, $path);
        }
    }

    private function viewLibrary()
    {
        $path = "./../pages/library.php";
        try {
            if (!isset($_SESSION['user_id'])) {
                throw new Exception("You must be logged in to view your library.");
            }

            $user_id = $_SESSION['user_id'];
            $stmt = $this->pdo->prepare("SELECT library.* FROM user_library JOIN library ON user_library.game_id = library.game_id WHERE user_library.user_id = ?");
            if (!$stmt->execute([$user_id])) {
                throw new Exception("Failed to fetch your library.");
            }

            $library = $stmt->fetchAll();
            include $path;
        } catch (Exception $e) {
            $errorMessage = $e->getMessage();
            $_SESSION['Error'] = true;
            $_SESSION['Message'] = $errorMessage;
            header("Location: ./../controllers/gameController.php?action=home");
        }
    }

    private function isGameInLibrary($user_id, $game_id)
    {
        $stmt = $this->pdo->prepare("SELECT COUNT(*) FROM user_library WHERE user_id = ? AND game_id = ?");
        $stmt->execute([$user_id, $game_id]);
        return $stmt->fetchColumn() > 0;
    }

    private function removeFromLibrary()
    {
        $path = "./../controllers/gameController.php?action=viewLibrary";
        try {
            if (!isset($_SESSION['user_id'])) {
                throw new Exception("You must be logged in to remove a game from your library.");
            }

            $user_id = $_SESSION['user_id'];
            $game_id = $_POST['game_id'];

            $stmt = $this->pdo->prepare("DELETE FROM user_library WHERE user_id = ? AND game_id = ?");
            if (!$stmt->execute([$user_id, $game_id])) {
                throw new Exception("Failed to remove the game from your library.");
            }


            $this->logAction($user_id, 'removed from library', $game_id);

            $successMessage = "Game removed from your library successfully!";
            $this->redirect("Success", $successMessage, $path);
        } catch (Exception $e) {
            $errorMessage = $e->getMessage();
            $this->redirect("Error", $errorMessage, $path);
        }
    }

    public function logAction($user_id, $action, $game_id)
    {
        $stmt = $this->pdo->prepare("INSERT INTO action_logs (user_id, action, game_id) VALUES (?, ?, ?)");
        $stmt->execute([$user_id, $action, $game_id]);
    }

    private function addToCollection()
    {
        $path = "./../controllers/gameController.php?action=viewLibrary";
        try {
            if (!isset($_SESSION['user_id'])) {
                throw new Exception("You must be logged in to add a game to your collection.");
            }

            $user_id = $_SESSION['user_id'];
            $game_id = $_POST['game_id'];


            $stmt = $this->pdo->prepare("INSERT INTO user_library (user_id, game_id) VALUES (?, ?)");
            if (!$stmt->execute([$user_id, $game_id])) {
                throw new Exception("Failed to add the game to your collection.");
            }


            $this->logAction($user_id, 'added to library', $game_id);

            $successMessage = "Game added to your collection successfully!";
            $this->redirect("Success", $successMessage, $path);
        } catch (Exception $e) {
            $errorMessage = $e->getMessage();
            $this->redirect("Error", $errorMessage, $path);
        }
    }

    private function viewLogs()
    {
        $path = "./../pages/adminLogs.php";
        try {
            $stmt = $this->pdo->prepare("
                SELECT al.log_id, u.full_name, g.game_name, al.action, al.game_id, al.timestamp 
                FROM action_logs al
                LEFT JOIN users u ON al.user_id = u.user_id
                LEFT JOIN library g ON al.game_id = g.game_id
                ORDER BY al.timestamp DESC
            ");
            $stmt->execute();
            $logs = $stmt->fetchAll();
            include $path;
        } catch (Exception $e) {
            $errorMessage = $e->getMessage();
            $_SESSION['Error'] = true;
            $_SESSION['Message'] = $errorMessage;
            header("Location: ./../controllers/gameController.php?action=home");
        }
    }
}


if (isset($_GET['action'])) {
    $userController = new gameController();
    $userController->request_handler();
}
