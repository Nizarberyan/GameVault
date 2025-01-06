<?php
require_once __DIR__ . '../../config/Db.php';
require_once __DIR__ . '../../Classes/User.php';
$pdo = Db::getInstance();
$user = new User($pdo);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $confirmPassword = $_POST['confirmPassword'] ?? '';

    if (empty($username) || empty($email) || empty($password) || empty($confirmPassword)) {
        $error = "All fields are required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Invalid email format.";
    } elseif ($password !== $confirmPassword) {
        $error = "Passwords do not match.";
    } else {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        if ($user->insertUser($username, $email, $hashedPassword)) {
            header('Location: ?page=login');
            exit();
        } else {
            $error = "Failed to create account. Please try again.";
        }
    }
}
?>

<div class="bg-[var(--secondary)] p-8 rounded-lg shadow-lg w-96">
    <h2 class="text-2xl font-bold mb-6 text-center text-[var(--accent)]">Create Account</h2>

    <form class="space-y-6" method="POST" action="?page=signup"> <!-- Corrected action -->
        <div>
            <label class="block mb-2 text-sm font-medium text-[var(--text)]">Username</label>
            <input type="text" name="username" required
                class="w-full p-3 rounded bg-[var(--background)] border border-[var(--primary)] focus:outline-none focus:border-[var(--accent)]">
        </div>

        <div>
            <label class="block mb-2 text-sm font-medium text-[var(--text)]">Email</label>
            <input type="email" name="email" required
                class="w-full p-3 rounded bg-[var(--background)] border border-[var(--primary)] focus:outline-none focus:border-[var(--accent)]">
        </div>

        <div>
            <label class="block mb-2 text-sm font-medium text-[var(--text)]">Password</label>
            <input type="password" name="password" required
                class="w-full p-3 rounded bg-[var(--background)] border border-[var(--primary)] focus:outline-none focus:border-[var(--accent)]">
        </div>

        <div>
            <label class="block mb-2 text-sm font-medium text-[var(--text)]">Confirm Password</label>
            <input type="password" name="confirmPassword" required
                class="w-full p-3 rounded bg-[var(--background)] border border-[var(--primary)] focus:outline-none focus:border-[var(--accent)]">
        </div>

        <button type="submit"
            class="w-full py-3 bg-[var(--primary)] hover:bg-[var(--accent)] rounded font-medium transition-colors">
            Sign Up
        </button>
    </form>

    <div class="mt-4 text-center text-sm">
        <a href="?page=login" class="text-[var(--accent)] hover:text-[var(--primary)]">Already have an account? Login</a>
    </div>
</div>