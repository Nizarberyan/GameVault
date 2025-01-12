<?php require_once("./../pages/header.php") ?>
<?php if (!isset($_SESSION['user_id']) && $_SESSION['role'] !== 'Admin') {
    header("Location: ./../controllers/gameController.php?action=home");
    exit();
}
?>
<div class="container mx-auto space-y-6 min-h-[85vh] mt-5 mb-5 p-5 flex flex-col justify-center">
    <section class="bg-[var(--secondary)] rounded-lg p-6 shadow-md">
        <h2 class="text-lg font-semibold text-[var(--primary)] mb-4">Manage Games</h2>
        <div class="flex flex-wrap items-center justify-center gap-5">
            <button onclick="openModal()" class="w-[40%] bg-[var(--accent)] text-[var(--text)] py-2 px-4 rounded-lg hover:bg-opacity-90">
                Add new Game
            </button>
            <button class="w-[40%] bg-[var(--primary)] text-[var(--text)] py-2 px-4 rounded-lg hover:bg-opacity-90">
                <a href="./../controllers/gameController.php?action=ER">Show All Games</a>
            </button>
        </div>
    </section>

    <section class="bg-[var(--secondary)] rounded-lg p-6 shadow-md">
        <h2 class="text-lg font-semibold text-[var(--primary)] mb-4">Manage User Roles</h2>
        <button
            class="w-full bg-[var(--accent)] text-[var(--text)] py-2 px-4 rounded-lg hover:bg-opacity-90"
            onclick="toggleSection('role-management')">
            Manage Roles<span><svg class="inline" xmlns="http://www.w3.org/2000/svg" fill="#fff" width="30px" height="30px" viewBox="0 0 24 24">
                    <path d="M7 10l5 5 5-5z" />
                </svg>
            </span>
        </button>
        <div id="role-management" class="hidden mt-4 space-y-2">
            <?php foreach ($users as $user):
                extract($user);
                if ($_SESSION['user_id'] !== $user): ?>
                    <div class="flex items-center justify-between p-2 bg-[var(--secondary)] rounded-lg shadow">
                        <span><?= $full_name ?></span>
                        <div class="space-x-2">
                            <form action="./../controllers/userController.php?action=changeRole" method="POST">
                                <input type="hidden" name="user_id" value="<?= $user_id ?>">
                                <input type="hidden" name="reversed_role" value="<?= $reverseRole($role) ?>">
                                <button class="bg-[var(--accent)] text-[var(--text)] py-1 px-3 rounded hover:bg-opacity-90">To <?= $reverseRole($role) ?></button>
                            </form>
                        </div>
                    </div>
            <?php endif;
            endforeach; ?>
        </div>
    </section>

    <section class="bg-[var(--secondary)] rounded-lg p-6 shadow-md">
        <h2 class="text-lg font-semibold text-[var(--primary)] mb-4">Manage Users</h2>
        <button
            class="w-full bg-red-500 text-[var(--text)] py-2 px-4 rounded-lg hover:bg-red-600"
            onclick="toggleSection('ban-management')">
            Check<span><svg class="inline" xmlns="http://www.w3.org/2000/svg" fill="#fff" width="30px" height="30px" viewBox="0 0 24 24">
                    <path d="M7 10l5 5 5-5z" />
                </svg>
            </span>
        </button>
        <div id="ban-management" class="hidden mt-4 space-y-2">
            <?php foreach ($users as $user):
                extract($user);
                if ($_SESSION['user_id'] !== $user && $role !== "Admin"): ?>
                    <div class="flex items-center justify-between p-2 bg-[var(--secondary)] rounded-lg shadow">
                        <span><?= $full_name ?></span>
                        <form action="./../controllers/userController.php?action=banManage" method="POST">
                            <input type="hidden" name="user_id" value="<?= $user_id ?>">
                            <input type="hidden" name="is_banned" value="<?= $is_banned === 0 ? 1 : 0 ?>">
                            <button class="bg-red-500 text-[var(--text)] py-1 px-3 rounded hover:bg-red-600"><?= $is_banned === 0 ? 'Ban' : "Unban" ?></button>
                        </form>
                    </div>
            <?php endif;
            endforeach; ?>
        </div>
    </section>
</div>

<?php require_once("./../pages/footer.php") ?>
<?php require_once("./../pages/gameForm.php") ?>

<script>
    function toggleSection(sectionId) {
        const section = document.getElementById(sectionId);
        section.classList.toggle('hidden');
    }
</script>