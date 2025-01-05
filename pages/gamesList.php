<?php require_once("./../pages/header.php") ?>

<div class="container mx-auto min-h-[85vh] p-5">
    <header class="mb-6 mt-2">
        <h1 class="text-2xl font-semibold text-[var(--primary)]">Games Edit/Delete</h1>
    </header>

    <div class="mb-6">
        <input
            type="text"
            id="search-bar"
            placeholder="Search for a game..."
            class="w-[60%] p-2 rounded bg-[var(--secondary)] text-[var(--text)] focus:outline-none focus:ring-2 focus:ring-[var(--accent)]"
            oninput="searchGames()" />
    </div>

    <div id="games-list" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
        <?php
        foreach ($info as $game) :
            extract($game);
        ?>
            <div class='game-card bg-[var(--secondary)] p-4 rounded shadow h-[500px] flex flex-col justify-between'>
                <div>
                    <img src='<?= $game_img ?>' alt='' class='w-full h-40 object-cover rounded mb-4'>
                    <h3 class='text-lg font-bold mb-2'><?= $game_name ?></h3>
                    <p class='text-sm mb-4 line-clamp-3'><?= substr($game_desc, 0, 89)."..." ?></p>
                    <div class='text-sm'>
                        <p>Release Date: <?= $release_date ?></p>
                        <p>Developer: <?= $developer ?></p>
                        <p>Publisher: <?= $publisher ?></p>
                    </div>
                </div>
                <form action='' method='POST'>
                    <input type='hidden' name='game_title' value='<?= $game_id ?>'>
                    <button type='submit' class='w-full px-4 py-2 bg-[var(--primary)] text-white rounded hover:bg-[var(--accent)]'>Edit</button>
                </form>
                <form action='' method='POST'>
                    <input type='hidden' name='game_title' value='<?= $game_id ?>'>
                    <button type='submit' class='w-full px-4 py-2 bg-[var(--primary)] text-white rounded hover:bg-[var(--accent)]'>Delete</button>
                </form>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<?php require_once("./../pages/footer.php") ?>

<script>
    function searchGames() {
        const searchQuery = document.getElementById('search-bar').value.toLowerCase();
        const gameCards = document.querySelectorAll('.game-card');

        gameCards.forEach(card => {
            const gameTitle = card.querySelector('h3').textContent.toLowerCase();
            if (gameTitle.includes(searchQuery)) {
                card.style.display = '';
            } else {
                card.style.display = 'none';
            }
        });
    }
</script>