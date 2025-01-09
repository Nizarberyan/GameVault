<?php
require_once __DIR__ . '/../config/Db.php';
require_once __DIR__ . '/../Classes/User.php';

session_start();

$pdo = Db::getInstance();
$user = new User($pdo);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    if ($user->login($email, $password)) {
        $_SESSION['Success'] = true;
        $_SESSION['Message'] = "Welcome back!";
        header('Location: ./../controllers/gameController.php?action=home');
        exit();
    } else {
        $_SESSION['Error'] = true;
        $_SESSION['Message'] = "Invalid email or password";
        header('Location: ./../pages/login.php');
        exit();
    }
}

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
