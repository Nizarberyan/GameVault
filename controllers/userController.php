<?php
require_once __DIR__ . '/../config/Db.php';
require_once __DIR__ . '/../Classes/User.php';

session_start();

$pdo = Db::getInstance();
$user = new User($pdo);



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
                if (isset($_SESSION['user_id'])) {
                    $this->accRender();
                } else {
                    header('Location: ./../pages/login.php');
                    exit();
                }
                break;

            case "accEdit":
                $this->accEdit();
                break;
            case "login":
                $this->login();
                break;

            case "modify":
                $this->accModify();
                break;
        }
    }
    public function login()
    {
        $user = new User($this->pdo);
        $user->login($_POST['email'], $_POST['password']);
        header("Location: ./../controllers/gameController.php?action=home");
        exit();
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
            if ($user->validation()) {
                // Retrieve inputs
                $full_name = $_POST['full_name'];
                $email = $_POST['email'];
                $bio = $_POST['bio'] ?? '';
                $user_id = $_POST['user_id'];
                $old_profile_img = $_POST['old_profile_img'];



                $user->accModify();


                header("Location: ./../controllers/userController.php?action=on");
                exit();
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

if (isset($_GET['action']) && $_GET['action'] === 'destroy') {

    $_SESSION = array();


    if (isset($_COOKIE[session_name()])) {
        setcookie(session_name(), '', time() - 3600, '/');
    }


    session_destroy();


    header('Location: ./../pages/login.php');
    exit();
}

$userController = new userController();
if (isset($_GET['action'])) {
    $userController->request_handler();
} else {
    $userController->usersRendering();
}
