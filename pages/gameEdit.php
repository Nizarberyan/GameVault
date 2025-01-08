<?php require_once("./../pages/header.php") ?>

<div id="gameForm" class="bg-black bg-opacity-50 flex items-center justify-center min-h-screen p-4">
    <div class="bg-[var(--secondary)] p-5 rounded-lg w-full max-w-md flex flex-col">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-bold text-white">Add New Game</h2>
        </div>
        <form action="./../controllers/gameController.php?action=updateGame" method="POST" enctype="multipart/form-data" class="space-y-4 flex-grow">
            <input type="hidden" name="old_Url" value="<?= $r2_url ?? '' ?>">
            <input type="hidden" name="game_id" value="<?= $game_id ?? '' ?>">
            <div>
                <label class="block text-sm font-medium text-white mb-1">Title</label>
                <div class="flex gap-2">
                    <input type="text" name="Title" id="title" required class="w-full p-2 rounded bg-[var(--background)] text-white" value="<?= $game_name ?? '' ?>">
                    <button type="button" id="AutoFill" class="px-4 bg-[var(--primary)] text-white text-xs rounded hover:bg-[var(--accent)]">
                        Auto Fill
                    </button>
                </div>
            </div>
            <div>
                <label class="block text-sm font-medium text-white mb-1">Description</label>
                <textarea name="description" id="description"
                    class="resize-none w-full p-2 rounded bg-[var(--background)] text-white h-32"><?= $game_desc ?? '' ?></textarea>
            </div>
            <div>
                <label class="block text-sm font-medium text-white mb-1">Game Poster (URL)</label>
                <input type="url" name="image" id="image" required class="w-full p-2 rounded bg-[var(--background)] text-white" value="<?= $game_img ?? '' ?>">
            </div>
            <div>
                <label class="block text-sm font-medium text-white mb-1">Release Date</label>
                <input type="date" name="release_date" id="release_date" required class="w-full p-2 rounded bg-[var(--background)] text-white" value="<?= $release_date ?? '' ?>">
            </div>
            <div>
                <label class="block text-sm font-medium text-white mb-1">Developer</label>
                <input type="text" name="developer" id="developer" required class="w-full p-2 rounded bg-[var(--background)] text-white" value="<?= $developer ?? '' ?>">
            </div>
            <div>
                <label class="block text-sm font-medium text-white mb-1">Publisher</label>
                <input type="text" name="publisher" id="publisher" required class="w-full p-2 rounded bg-[var(--background)] text-white" value="<?= $publisher ?? '' ?>">
            </div>
            <div class="flex gap-4">
                <div class="flex-1">
                    <label class="block text-sm font-medium text-white mb-1">Game Category</label>
                    <select name="category" id="category" class="w-full p-2 rounded bg-[var(--background)] text-white">
                        <option disabled selected value="">-- Select a category --</option>
                        <option value="action">Action</option>
                        <option value="adventure">Adventure</option>
                    </select>
                </div>
                <div class="flex-1">
                    <label class="block text-sm font-medium text-white mb-1">Rating</label>
                    <input type="number" name="rating" id="rating" class="w-full p-2 rounded bg-[var(--background)] text-white" value="<?= $rating ?? '' ?>">
                </div>
            </div>
            <div>
                <label class="block text-sm font-medium text-white mb-1">Additional Image1 (URL)</label>
                <input type="text" name="additional_img" id="additional_img" class="w-full p-2 rounded bg-[var(--background)] text-white" value="<?= $r1_url ?? '' ?>">
            </div>
            <div>
                <label class="block text-sm font-medium text-white mb-1">Additional Image2</label>
                <input type="file" name="additional_img2" id="additional_img2" class="w-full p-2 rounded bg-[var(--background)] text-white">
                <div id="imagePreviews" class="mt-2 flex flex-wrap gap-2" bis_skin_checked="1">
                    <div class="relative w-20 h-20 border rounded" bis_skin_checked="1">
                        <img src="<?= $r2_url ?? '' ?>" alt="Preview" class="w-full h-full object-cover rounded">
                        <button onclick="removeImage()" class="absolute top-0 right-0 bg-red-600 text-white rounded-full p-1 text-xs">X</button>
                    </div>
                </div>
            </div>
            <button type="submit" id="addGame" class="w-full bg-[var(--primary)] text-white py-2 rounded hover:bg-[var(--accent)]">Add Game</button>
        </form>
    </div>
</div>

<?php require_once("./../pages/footer.php") ?>