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
        }
    }

    private function gameAdd()
    {
        $path = "./../pages/dashboard.php";
        try {
            $newGame = new Game($this->pdo);
            $newGame->addGame();
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
}

if (isset($_GET['action'])) {
    $userController = new gameController();
    $userController->request_handler();
}
