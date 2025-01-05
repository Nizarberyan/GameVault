<?php
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
        }
    }

    private function gameAdd()
    {
        $path = "./../pages/dashboard.php";
        try {
            $newGame = new Game($this->pdo);
            if (!isset($_FILES['additional_img2']) && $_FILES['additional_img2']['error'] === UPLOAD_ERR_OK) {
                throw new Exception("No file uploaded or an upload error occurred.");
            }
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
            $newGame->addGame($target_dir);
            $successMessage = "Game added seccussfuly!!";
            $this->redirect("success", $successMessage, $path);
        } catch (Exception $e) {
            $errorMessage = $e->getMessage();
            $this->redirect("error", $errorMessage, $path);
            exit();
        }
    }

    private function redirect($var, $message, $path)
    {
        header("Location: " . $path . "?" . $var . "=" . urlencode($message));
    }

    private function gameRenderForER()
    {
        $path = "./../pages/dashboard.php";
        try {
            $newGame = new Game($this->pdo);
            $newGame->gamesRenderer();
        } catch (Exception $e) {
            $errorMessage = $e->getMessage();
            $this->redirect("error", $errorMessage, $path);
            exit();
        }
    }

    private function deleteGame()
    {
        $path = "./../controllers/gameController.php?action=ER&";
        try {
            if (!isset($_POST["game_id"])) {
                throw new Exception("Something went wrong. try again");
            }
            $newGame = new Game($this->pdo);
            $newGame->deleteGame((int)$_POST["game_id"]);
            $successMessage = "Game has been deleted seccussfuly!!";
            $this->redirect("success", $successMessage, $path);
        } catch (Exception $e) {
            $errorMessage = $e->getMessage();
            $this->redirect("error", $errorMessage, $path);
            exit();
        }
    }
}

if (isset($_GET['action'])) {
    $userController = new gameController();
    $userController->request_handler();
}
