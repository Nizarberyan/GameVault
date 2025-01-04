<?php include 'header.php'; ?>
<main class="container mx-auto px-4 my-8 space-y-8 min-h-screen">
    <section class="bg-[var(--secondary)] p-6 rounded shadow">
        <h2 class="text-xl font-bold mb-4">Available Games</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            <div class="bg-[var(--background)] p-4 rounded-lg shadow">
                <img src="" alt="Game Cover" class="w-full h-48 object-cover rounded mb-4">
                <h3 class="text-lg font-semibold mb-2">Game Title</h3>
                <p class="text-sm text-gray-400">Developer</p>
            </div>
        </div>
    </section>

    <button onclick="openModal()" class="fixed bottom-4 right-4 bg-[var(--primary)] text-white p-4 rounded-full shadow-lg hover:bg-[var(--accent)]">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
        </svg>
    </button>
</main>

<footer class="bg-[var(--secondary)] text-white py-4">
    <div class="container mx-auto text-center">
        <p>&copy; <?php echo date("Y"); ?> Game Collection Platform. All rights reserved.</p>
    </div>
</footer>

<!-- Add Game Modal -->
<div id="addGameModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 p-4">
    <div class="bg-[var(--secondary)] p-6 rounded-lg w-full max-w-md">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-bold">Add New Game</h2>
            <button onclick="closeModal()" class="text-gray-500 hover:text-white">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
        <form action="" method="POST" class="space-y-4">
            <div>
                <label class="block text-sm font-medium mb-1">Title</label>
                <div class="flex gap-2">
                    <input type="text" name="Title" id="title" required class="w-full p-2 rounded bg-[var(--background)] text-white">
                    <button type="button" id="AutoFill" class="px-4 py-2 bg-[var(--primary)] text-white rounded hover:bg-[var(--accent)]">
                        Auto Fill
                    </button>
                </div>
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">Description</label>
                <textarea name="description" id="description" class="w-full p-2 rounded bg-[var(--background)] text-white"></textarea>
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">Image URL</label>
                <input type="url" name="image" id="image" required class="w-full p-2 rounded bg-[var(--background)] text-white">
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">Release Date</label>
                <input type="date" name="release_date" id="release_date" required class="w-full p-2 rounded bg-[var(--background)] text-white">
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">Developer</label>
                <input type="text" name="developer" id="developer" required class="w-full p-2 rounded bg-[var(--background)] text-white">
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">Publisher</label>
                <input type="text" name="publisher" id="publisher" required class="w-full p-2 rounded bg-[var(--background)] text-white">
            </div>
            <button type="submit" id="addGame" class="w-full bg-[var(--primary)] text-white py-2 rounded hover:bg-[var(--accent)]">Add Game</button>
        </form>
    </div>
</div>

<script>
    function openModal() {
        document.getElementById('addGameModal').classList.remove('hidden');
    }

    function closeModal() {
        document.getElementById('addGameModal').classList.add('hidden');
    }
</script>
