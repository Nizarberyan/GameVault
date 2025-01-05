<?php
require_once("./../classes/User.php");
require_once("./../config/Db.php");

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
            header("Location: ./../pages/profile.php?error=" . urlencode($errorMessage));
            exit();
        }
    }

    private function accModify()
    {
        try {
            $user = new User($this->pdo);
            if ($user->validation()) { //validation function need some improvement and fixing!!!!
                $user->accModify();
            }
        } catch (Exception $e) {
            $errorMessage = $e->getMessage();
            header("Location: ./../pages/profile_edit.php?error=" . urlencode($errorMessage));
            exit();
        }
    }
}

if (isset($_GET['action'])) {
    $userController = new userController();
    $userController->request_handler();
}
