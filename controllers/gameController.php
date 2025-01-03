<?php
require_once("./../config/Db.php");
require_once("./../classes/game.php");

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
        try {
            $newGame = new Game($this->pdo);
            $newGame->addGame();
        } catch (Exception $e) {
            $errorMessage = $e->getMessage();
            header("Location: ./../pages/dashboard.php?error=" . urlencode($errorMessage));
            exit();
        }
        header("Location: ./../pages/dashboard.php");
    }
}

if (isset($_GET['action'])) {
    $userController = new gameController();
    $userController->request_handler();
}
