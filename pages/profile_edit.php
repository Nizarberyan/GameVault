<?php
include_once("./../pages/header.php");
?>
<?php if (isset($_GET['error'])): ?>
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
        <strong class="font-bold">Error: </strong>
        <span class="block sm:inline"><?= htmlspecialchars($_GET['error']); ?></span>
        <button type="button" class="absolute top-0 bottom-0 right-0 px-4 py-3" onclick="this.parentElement.style.display='none';">
            <svg class="fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                <title></title>
                <path d="M14.348 5.652a1 1 0 011.415 0l.086.086a1 1 0 010 1.415L11.415 11l4.434 4.434a1 1 0 01-1.415 1.415L10 12.415l-4.434 4.434a1 1 0 01-1.415-1.415L8.585 11 4.152 6.566a1 1 0 011.415-1.415L10 9.585l4.348-4.348z" />
            </svg>
        </button>
    </div>
<?php endif; ?>

<main class="container mx-auto my-10 px-6">
    <section class="flex justify-center">
        <div class="bg-[var(--primary)] rounded-lg shadow-xl w-full max-w-3xl p-6">
            <h2 class="text-3xl font-semibold text-[var(--text)] text-center mb-6">Edit Profile</h2>

            <form action="./../controllers/userController.php?action=accModify" method="POST" enctype="multipart/form-data">
                <div class="flex justify-center mb-6">
                    <label for="profile_image" class="cursor-pointer">
                        <img src="<?= $profile_img; ?>" alt="Profile Picture" id="profileImage" class="w-32 h-32 rounded-full border-4 border-[var(--accent)] mb-4">
                        <span class="text-[var(--text)] hover:text-indigo-800 text-sm">Change Profile Picture</span>
                    </label>
                    <input type="file" id="profile_image" name="profile_image" class="hidden" onchange="previewImage(event)">
                    <input type="hidden" name="user_id" value="<?= $user_id; ?>">
                    <input type="hidden" name="old_profile_img" value="<?= $profile_img; ?>">
                </div>

                <div class="mb-4">
                    <label for="full_name" class="block text-sm font-medium text-[var(--text)]">Full Name</label>
                    <input type="text" id="full_name" name="full_name" value="<?= $full_name; ?>" required class="border-none bg-[var(--background)] mt-1 p-3 block w-full border-2 border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500">
                </div>

                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-[var(--text)]">Email</label>
                    <input type="email" id="email" name="email" value="<?= $email; ?>" required class="border-none bg-[var(--background)] mt-1 p-3 block w-full border-2 border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500">
                </div>

                <div class="mb-6">
                    <label for="bio" class="block text-sm font-medium text-[var(--text)]">Bio</label>
                    <textarea id="bio" name="bio" rows="4" class="border-none bg-[var(--background)] mt-1 p-3 block w-full border-2 border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500"><?php echo $bio; ?></textarea>
                </div>

                <div class="flex justify-center">
                    <button type="submit" class="bg-indigo-600 text-[var(--text)] py-2 px-6 rounded-lg shadow hover:bg-indigo-700 transition duration-200">
                        Save Changes
                    </button>
                </div>
            </form>
        </div>
</section>
</main>

<?php
include_once("./../pages/footer.php");
?>