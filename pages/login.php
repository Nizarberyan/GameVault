<?php
require_once __DIR__ . '/../pages/header.php';
require_once __DIR__ . '/../config/Db.php';
require_once __DIR__ . '/../Classes/User.php';
$pdo = Db::getInstance();
$user = new User($pdo);
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (isset($_SESSION['user_id'])) {
    header("Location: ./../pages/home.php");
    exit;
}


?>

<div class="min-h-screen flex items-center justify-center">
    <div class="bg-[var(--secondary)] p-8 rounded-lg shadow-lg w-full max-w-md">
        <h2 class="text-2xl font-bold text-center mb-6">Login</h2>
        <form action="./../controllers/userController.php" method="POST">
            <div class="mb-4">
                <label class="block text-sm font-medium mb-2">Email</label>
                <input type="email" name="email" class="w-full p-2 rounded bg-[var(--background)] border border-[var(--accent)]" required>
            </div>
            <div class="mb-6">
                <label class="block text-sm font-medium mb-2">Password</label>
                <input type="password" name="password" class="w-full p-2 rounded bg-[var(--background)] border border-[var(--accent)]" required>
            </div>
            <button type="submit" name="action" value="login" class="w-full bg-[var(--primary)] text-white py-2 px-4 rounded hover:bg-[var(--accent)]">
                Login
            </button>
        </form>
        <p class="mt-4 text-center">
            Don't have an account? <a href="?page=signup" class="text-[var(--accent)] hover:underline">Sign up here</a>
        </p>
    </div>
</div>
</div>