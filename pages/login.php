<?php
require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../../Classes/User.php';
$pdo = Db::getInstance();
$user = new User($pdo);
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    if (empty($email) || empty($password)) {
        $error = "All fields are required.";
    } else {
        $db = new Database();
        $userId = $user->loginUser($email, $password);

        if ($userId) {
            $_SESSION['user_id'] = $userId;
            header('Location: ?page=home');
            exit();
        } else {
            $error = "Invalid email or password.";
        }
    }
}
?>

<div class="bg-[var(--secondary)] p-8 rounded-lg shadow-lg w-96">
    <h2 class="text-2xl font-bold mb-6 text-center text-[var(--accent)]">Welcome Back</h2>

    <?php if (isset($error)): ?>
        <div class="text-red-500 text-center mb-4"><?php echo $error; ?></div>
    <?php endif; ?>

    <form class="space-y-6" method="POST" action="?page=login">
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

        <button type="submit"
            class="w-full py-3 bg-[var(--primary)] hover:bg-[var(--accent)] rounded font-medium transition-colors">
            Login
        </button>
    </form>

    <div class="mt-4 text-center text-sm">
        <a href="?page=signup" class="text-[var(--accent)] hover:text-[var(--primary)]">Need an account? Sign up</a>
    </div>
</div>