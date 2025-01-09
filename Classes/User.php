<?php
class User
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function accRender()
    {
        $user_id = $_SESSION['user_id'];
        $info = $this->pdo->prepare("SELECT * FROM users WHERE user_id = ?;");
        $info->bindParam(1, $user_id);
        $info->execute();
        $row = $info->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            extract($row);
        } else {
            throw new Exception("Something went wrong. try again.");
        }
        include("./../pages/profile.php");
    }

    public function accEdit()
    {
        $user_id = (int) $_SESSION['user_id'];
        $info = $this->pdo->prepare("SELECT * FROM users WHERE user_id = :user_id;");
        $info->bindParam(":user_id", $user_id, PDO::PARAM_STR);
        $info->execute();
        $row = $info->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            extract($row);
        } else {
            throw new Exception("Something went wrong. try again.");
        }
        include("./../pages/profile_edit.php");
    }

    public function validation()
    {
        $user_id = (int) $_SESSION['user_id'];
        die($user_id);
        if (empty($_POST['full_name']) || empty($_POST['email'])) {
            throw new Exception("Full name OR email should not be empty.");
        }

        if (!empty($_POST['bio'])) {
            if (!preg_match("/^[a-zA-Z\s]+$/", $_POST['bio'])) {
                throw new Exception("Bio must only contain letters and spaces.");
            }
        }

        if (!preg_match("/^[a-zA-Z\s]+$/", $_POST['full_name'])) {
            throw new Exception("Full name must only contain letters and spaces.");
        }

        if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            throw new Exception("Invalid email format.");
        }

        $emails = $this->pdo->prepare("SELECT email, full_name FROM users WHERE user_id != ?;");
        $emails->execute([$user_id]);
        $rows = $emails->fetchAll(PDO::FETCH_ASSOC);

        foreach ($rows as $row) {
            if ($row["email"] == $_POST['email'] || $row["full_name"] == $_POST['full_name']) {
                throw new Exception("Email or user name already taken.");
            }
        }

        return true;
    }

    public function accModify()
    {
        $full_name = $_POST['full_name'];
        $email = $_POST['email'];
        $bio = $_POST['bio'];
        $user_id = $_POST['user_id'];
        $old_profile_img = $_POST['old_profile_img'];

        if (isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] === UPLOAD_ERR_OK) {
            $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
            if (!in_array($_FILES['profile_image']['type'], $allowedTypes)) {
                throw new Exception("Invalid file type. Only JPEG, PNG, and GIF are allowed.");
            }
            $target_dir = "./../assests/";
            $file_extension = strtolower(pathinfo($_FILES['profile_image']['name'], PATHINFO_EXTENSION));
            $unique_file_name = uniqid() . '.' . $file_extension;
            $profile_img = $target_dir . $unique_file_name;

            if (!move_uploaded_file($_FILES['profile_image']['tmp_name'], $profile_img)) {
                throw new Exception("Failed to upload the file.");
            }
            unlink($old_profile_img);
            $update = $this->pdo->prepare("UPDATE users SET full_name = :full_name, email = :email, profile_img = :profile_img, bio = :bio WHERE user_id = :user_id");
            $update->bindParam(":profile_img", $profile_img);
        } else {
            $update = $this->pdo->prepare("UPDATE users SET full_name = :full_name, email = :email, bio = :bio WHERE user_id = :user_id");
        }

        $update->bindParam(":full_name", $full_name);
        $update->bindParam(":email", $email);
        $update->bindParam(":bio", $bio);
        $update->bindParam(":user_id", $user_id, PDO::PARAM_INT);
        $update->execute();

        header("Location: ./../controllers/userController.php?action=on");
    }

    public function insertUser($username, $email, $password)
    {
        $stmt = $this->pdo->prepare("INSERT INTO users (full_name, email, user_psw) VALUES (?, ?, ?)");
        $stmt->bindParam(1, $username);
        $stmt->bindParam(2, $email);
        $stmt->bindParam(3, $password);
        return $stmt->execute();
    }
    public function login($email, $password)
    {
        $stmt = $this->pdo->prepare("SELECT user_id, user_psw, role FROM users WHERE email = ?");
        $stmt->bindParam(1, $email);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($user && password_verify($password, $user['user_psw'])) {
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role'];
            return true;
        }
        return false;
    }

    public function usersRendering()
    {
        $users = $this->pdo->prepare("SELECT full_name, user_id, role FROM users");
        $users->execute();
        return $users->fetchAll(PDO::FETCH_ASSOC);
    }
}
