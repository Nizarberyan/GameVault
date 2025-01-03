<?php require_once("./../pages/header.php") ?>

<div class="container mx-auto space-y-6 min-h-[75vh] mt-5 mb-5">
    <section class="bg-[var(--secondary)] rounded-lg p-6 shadow-md">
        <h2 class="text-lg font-semibold text-[var(--primary)] mb-4">Manage Games</h2>
        <div class="space-y-4">
            <button class="w-full bg-[var(--accent)] text-[var(--text)] py-2 px-4 rounded-lg hover:bg-opacity-90">
                Add Games
            </button>
            <button class="w-full bg-[var(--primary)] text-[var(--text)] py-2 px-4 rounded-lg hover:bg-opacity-90">
                Edit Game
            </button>
            <button class="w-full bg-red-500 text-[var(--text)] py-2 px-4 rounded-lg hover:bg-red-600">
                Delete Game
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
            <div class="flex items-center justify-between p-2 bg-[var(--secondary)] rounded-lg shadow">
                <span>User1</span>
                <div class="space-x-2">
                    <button class="bg-[var(--accent)] text-[var(--text)] py-1 px-3 rounded hover:bg-opacity-90">To User</button>
                </div>
            </div>
            <div class="flex items-center justify-between p-2 bg-[var(--secondary)] rounded-lg shadow">
                <span>User2</span>
                <div class="space-x-2 flex">
                    <button class="bg-[var(--accent)] text-[var(--text)] py-1 px-3 rounded hover:bg-opacity-90">To User</button>
                </div>
            </div>
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
            <div class="flex items-center justify-between p-2 bg-[var(--secondary)] rounded-lg shadow">
                <span>User1</span>
                <button class="bg-red-500 text-[var(--text)] py-1 px-3 rounded hover:bg-red-600">Ban</button>
            </div>
            <div class="flex items-center justify-between p-2 bg-[var(--secondary)] rounded-lg shadow">
                <span>User2</span>
                <button class="bg-red-500 text-[var(--text)] py-1 px-3 rounded hover:bg-red-600">Ban</button>
            </div>
        </div>
    </section>
</div>

<?php require_once("./../pages/footer.php") ?>

<script>
    function toggleSection(sectionId) {
        const section = document.getElementById(sectionId);
        section.classList.toggle('hidden');
    }
</script>