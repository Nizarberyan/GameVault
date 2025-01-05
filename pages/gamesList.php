<?php require_once("./../pages/header.php") ?>

<div class="container mx-auto min-h-[85vh] p-5 relative">
    <div class="absolute top-5 right-5 rotate-180">
        <a href="./../pages/dashboard.php">
            <svg width="50px" height="50px" viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg">

                <defs>

                    <style>
                        .cls-1 {
                            fill: none;
                            stroke: #fff;
                            stroke-linecap: round;
                            stroke-linejoin: round;
                            stroke-width: 20px;
                        }
                    </style>

                </defs>

                <g data-name="Layer 2" id="Layer_2">

                    <g data-name="E421, Back, buttons, multimedia, play, stop" id="E421_Back_buttons_multimedia_play_stop">

                        <circle class="cls-1" cx="256" cy="256" r="246" />

                        <line class="cls-1" x1="352.26" x2="170.43" y1="256" y2="256" />

                        <polyline class="cls-1" points="223.91 202.52 170.44 256 223.91 309.48" />

                    </g>

                </g>

            </svg>
        </a>
    </div>
    <header class="mb-6 mt-2">
        <h1 class="text-2xl font-semibold text-[var(--primary)]">Live Games</h1>
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
                    <p class='text-sm mb-4 line-clamp-3'><?= substr($game_desc, 0, 89) . "..." ?></p>
                    <div class='text-sm'>
                        <p>Rating: <?= $rating . "/100" ?></p>
                        <p>Release Date: <?= $release_date ?></p>
                        <p>Developer: <?= $developer ?></p>
                        <p>Publisher: <?= $publisher ?></p>
                    </div>
                </div>
                <button onclick="openModal()" class='w-full px-4 py-2 bg-[var(--primary)] text-white rounded hover:bg-[var(--accent)]'>Edit</button>
                <form action='./../controllers/gameController.php?action=deleteGame' method='POST'>
                    <input type='hidden' name='game_id' value='<?= $game_id ?>'>
                    <button type='submit' class='w-full px-4 py-2 bg-[var(--primary)] text-white rounded hover:bg-[var(--accent)]'>Delete</button>
                </form>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<?php require_once("./../pages/footer.php") ?>
<?php require_once("./../pages/gameForm.php") ?>