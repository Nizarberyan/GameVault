<?php
if (session_status() === PHP_SESSION_NONE) session_start();

spl_autoload_register(function ($class) {
    require_once "./../classes/" . $class . ".php";
});
require_once("./../config/Db.php");
// require_once("./../classes/Game.php");

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

    public function usersRendering()
    {
        $Users = new User($this->pdo);
        $users = $Users->usersRendering();
        $reverseRole = function ($role) {
            return $role === 'Admin' ? 'User' : 'Admin';
        };
        include "./../pages/dashboard.php";
    }
}

$userController = new userController();
if (isset($_GET['action'])) {
    $userController->request_handler();
} else {
    $userController->usersRendering();
}
