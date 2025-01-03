<?php
require_once("./../models/User.php");
require_once("./../models/Db.php");

class userController
{
    private $action;
    private $pdo;

    public function __construct()
    {
        $this->pdo = Db::getInstance();
    }

    public function request_handler()
    {
        $this->action = $_GET['action'];

        switch ($this->action) {
            case "register":
                $this->register();
                break;

            case "on":
                $this->accRender();
                break;

            case "accEdit":
                $this->accEdit();
                break;

            case "accModify":
                $this->accModify();
                break;
        }
    }

    private function register()
    {
        $user = new User($this->pdo);
    }

    private function accRender()
    {
        $user = new User($this->pdo);
        $user->accRender();
    }

    private function accEdit()
    {
        try {
            $user = new User($this->pdo);
            $user->accEdit();
        } catch (Exception $e) {
            $errorMessage = $e->getMessage();
            header("Location: ./../html/profile.php?error=" . urlencode($errorMessage));
            exit();
        }
    }

    private function accModify()
    {
        try {
            $user = new User($this->pdo);
            // if ($user->validation()){

            // }
            $user->accModify();
        } catch (Exception $e) {
            $errorMessage = $e->getMessage();
            header("Location: ./../html/profile_edit.php?error=" . urlencode($errorMessage));
            exit();
        }
    }
}

if (isset($_GET['action'])) {
    $userController = new userController();
    $userController->request_handler();
}
