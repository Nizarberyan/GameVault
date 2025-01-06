<?php
if (session_status() === PHP_SESSION_NONE) session_start();
require_once("./../config/Db.php");
require_once("./../classes/Game.php");

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

            $newGame->addGame($target_dir, $additional_img);
            $successMessage = "Game has been deleted seccussfuly!!";
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
            $successMessage = "Game has been deleted seccussfuly!!";
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
            $successMessage = "Game has been updated seccussfuly!!";
            $this->redirect("Success", $successMessage, $path);
        } catch (Exception $e) {
            $errorMessage = $e->getMessage();
            $this->redirect("Error", $errorMessage, $path);
            exit();
        }
    }
}

if (isset($_GET['action'])) {
    $userController = new gameController();
    $userController->request_handler();
}
