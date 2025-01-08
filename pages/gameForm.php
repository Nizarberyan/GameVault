<div id="gameForm" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center">
    <div class="bg-[var(--secondary)] p-5 rounded-lg w-full max-w-md h-[90vh] flex flex-col">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-bold">Add New Game</h2>
            <button onclick="closeModal()" class="text-gray-500 hover:text-white">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
        <form action="./../controllers/gameController.php?action=gCreate" method="POST" enctype="multipart/form-data"
            class="space-y-4 flex-grow overflow-y-auto">
            <div>
                <label class="block text-sm font-medium mb-1">Title</label>
                <div class="flex gap-2 h-10">
                    <input type="text" name="Title" id="title" required class="w-full p-2 rounded bg-[var(--background)] text-white">
                    <button type="button" id="AutoFill" class="px-4 bg-[var(--primary)] text-white text-xs rounded hover:bg-[var(--accent)]">
                        Auto Fill
                    </button>
                </div>
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">Description</label>
                <textarea name="description" id="description" class="resize-none w-full p-2 rounded bg-[var(--background)] text-white"></textarea>
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">Game Poster (URL)</label>
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
            <div class="flex gap-4">
                <div class="flex-1">
                    <label class="block text-sm font-medium mb-1">Game Category</label>
                    <select name="category" id="category" class="w-full p-2 rounded bg-[var(--background)] text-white">
                        <option disabled selected value="">-- Select a category --</option>
                        <option value="action">Action</option>
                        <option value="adventure">Adventure</option>
                    </select>
                </div>
                <div class="flex-1">
                    <label class="block text-sm font-medium mb-1">Rating</label>
                    <input type="number" name="rating" id="rating" class="w-full p-2 rounded bg-[var(--background)] text-white" value="">
                </div>
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">Additional Image1 (URL)</label>
                <input type="text" name="additional_img" id="additional_img" class="w-full p-2 rounded bg-[var(--background)] text-white" value="">
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">Additional Image2</label>
                <input type="file" name="additional_img2" id="additional_img2" class="w-full p-2 rounded bg-[var(--background)] text-white">
                <div id="imagePreviews" class="mt-2 flex flex-wrap gap-2"></div>
            </div>
            <button type="submit" id="addGame" class="w-full bg-[var(--primary)] text-white py-2 rounded hover:bg-[var(--accent)]">Add Game</button>
        </form>
    </div>
</div>

<script>
    function openModal() {
        document.getElementById('gameForm').classList.remove('hidden');
    }
    function closeModal() {
        document.getElementById('gameForm').classList.add('hidden');
    }
</script>