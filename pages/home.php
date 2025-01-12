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

<main class="container mx-auto px-6 py-10">

    <section>
        <h2 class="text-3xl font-semibold text-[var(--text)] mb-6 w-full border-b-2 p-2 text-center">Browse Games by Category</h2>

        <div class="mb-8">
            <h3 class="text-2xl font-semibold text-[var(--text)] mb-4">Action</h3>
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                <?php foreach ($info as $game):
                    extract($game);
                    $isInLibrary = false;
                    if (isset($_SESSION['user_id'])) {
                        $isInLibrary = $this->isGameInLibrary($_SESSION['user_id'], $game_id);
                    }
                    if ($category === "Action"): ?>
                        <div class='bg-[var(--secondary)] p-4 rounded shadow h-[500px] flex flex-col justify-between'>
                            <a href="./../controllers/gameController.php?action=gameDetails&id=<?= $game_id ?>" class="flex-grow">
                                <div>
                                    <img src='<?= $game_img ?>' alt='' class='w-full h-40 object-cover rounded mb-4'>
                                    <h3 class='text-lg font-bold mb-2'><?= $game_name ?></h3>
                                    <p class='text-sm mb-4 line-clamp-3'><?= substr($game_desc, 0, 130) . "..." ?></p>
                                    <div class='text-sm'>
                                        <p>Rating: <?= $rating . "/100" ?></p>
                                        <p>Release Date: <?= $release_date ?></p>
                                        <p>Developer: <?= $developer ?></p>
                                        <p>Publisher: <?= $publisher ?></p>
                                    </div>
                            </a>
                        </div>
                        <div>
                            <?php if (!isset($_SESSION['user_id'])): ?>
                                <div class="flex-1 p-3 rounded-lg bg-yellow-100 text-yellow-800 border border-yellow-300 flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="h-5 w-5 mr-2 fill-current text-yellow-800">
                                        <path d="M501.362 383.95 320.497 51.474c-29.059-48.921-99.896-48.986-128.994 0L10.647 383.95c-29.706 49.989 6.259 113.291 64.482 113.291h361.736c58.174 0 94.203-63.251 64.497-113.291zM256 437.241c-16.538 0-30-13.462-30-30s13.462-30 30-30 30 13.462 30 30-13.462 30-30 30zm30-120c0 16.538-13.462 30-30 30s-30-13.462-30-30v-150c0-16.538 13.462-30 30-30s30 13.462 30 30v150z" />
                                    </svg>
                                    Please log in to add to your library
                                </div>
                            <?php elseif ($_SESSION['is_banned'] === 1): ?>
                                <div class="flex-0 p-3 rounded-lg bg-yellow-100 text-yellow-800 border border-yellow-300 flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="h-5 w-5 mr-2 fill-current text-yellow-800">
                                        <path d="M501.362 383.95 320.497 51.474c-29.059-48.921-99.896-48.986-128.994 0L10.647 383.95c-29.706 49.989 6.259 113.291 64.482 113.291h361.736c58.174 0 94.203-63.251 64.497-113.291zM256 437.241c-16.538 0-30-13.462-30-30s13.462-30 30-30 30 13.462 30 30-13.462 30-30 30zm30-120c0 16.538-13.462 30-30 30s-30-13.462-30-30v-150c0-16.538 13.462-30 30-30s30 13.462 30 30v150z" />
                                    </svg>
                                    You are currently Banned
                                </div>
                            <?php else: ?>
                                <form action="./../controllers/gameController.php?action=<?= $isInLibrary ? 'removeFromLibrary' : 'addToLibrary' ?>" method="POST">
                                    <input type='hidden' name='game_id' value='<?= $game_id ?>'>
                                    <button type='submit' class='w-full px-8 py-4 text-lg bg-[var(--primary)] text-white rounded-lg hover:bg-[var(--accent)]'>
                                        <?= $isInLibrary ? 'Remove from Library' : 'Add to Library' ?>
                                    </button>
                                </form>
                            <?php endif; ?>
                        </div>
            </div>
        <?php endif ?>
    <?php endforeach ?>
        </div>
        </div>

        <div>
            <h3 class="text-2xl font-semibold text-[var(--text)] mb-4">Adventure</h3>
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                <?php foreach ($info as $game):
                    extract($game);
                    if ($category === "Adventure"): ?>
                        <div class='bg-[var(--secondary)] p-4 rounded shadow h-[500px] flex flex-col justify-between'>
                            <div>
                                <a href="./../controllers/gameController.php?action=gameDetails&id=<?= $game_id ?>">
                                    <img src='<?= $game_img ?>' alt='' class='w-full h-40 object-cover rounded mb-4'>
                                    <h3 class='text-lg font-bold mb-2'><?= $game_name ?></h3>
                                    <p class='text-sm mb-4 line-clamp-3'><?= substr($game_desc, 0, 130) . "..." ?></p>
                                    <br>
                                    <div class='text-sm'>
                                        <p>Rating: <?= $rating . "/100" ?></p>
                                        <p>Release Date: <?= $release_date ?></p>
                                        <p>Developer: <?= $developer ?></p>
                                        <p>Publisher: <?= $publisher ?></p>
                                    </div>
                                </a>
                            </div>
                            <div>
                                <?php if (!isset($_SESSION['user_id'])): ?>
                                    <div class="flex-1 p-3 rounded-lg bg-yellow-100 text-yellow-800 border border-yellow-300 flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="h-5 w-5 mr-2 fill-current text-yellow-800">
                                            <path d="M501.362 383.95 320.497 51.474c-29.059-48.921-99.896-48.986-128.994 0L10.647 383.95c-29.706 49.989 6.259 113.291 64.482 113.291h361.736c58.174 0 94.203-63.251 64.497-113.291zM256 437.241c-16.538 0-30-13.462-30-30s13.462-30 30-30 30 13.462 30 30-13.462 30-30 30zm30-120c0 16.538-13.462 30-30 30s-30-13.462-30-30v-150c0-16.538 13.462-30 30-30s30 13.462 30 30v150z" />
                                        </svg>
                                        Please log in to add to your library
                                    </div>
                                <?php elseif ($_SESSION['is_banned'] === 1): ?>
                                    <div class="flex-0 p-3 rounded-lg bg-yellow-100 text-yellow-800 border border-yellow-300 flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="h-5 w-5 mr-2 fill-current text-yellow-800">
                                            <path d="M501.362 383.95 320.497 51.474c-29.059-48.921-99.896-48.986-128.994 0L10.647 383.95c-29.706 49.989 6.259 113.291 64.482 113.291h361.736c58.174 0 94.203-63.251 64.497-113.291zM256 437.241c-16.538 0-30-13.462-30-30s13.462-30 30-30 30 13.462 30 30-13.462 30-30 30zm30-120c0 16.538-13.462 30-30 30s-30-13.462-30-30v-150c0-16.538 13.462-30 30-30s30 13.462 30 30v150z" />
                                        </svg>
                                        You are currently Banned
                                    </div>
                                <?php else: ?>
                                    <form action="./../controllers/gameController.php?action=<?= $isInLibrary ? 'removeFromLibrary' : 'addToLibrary' ?>" method="POST">
                                        <input type='hidden' name='game_id' value='<?= $game_id ?>'>
                                        <button type='submit' class='w-full px-8 py-4 text-lg bg-[var(--primary)] text-white rounded-lg hover:bg-[var(--accent)]'>
                                            <?= $isInLibrary ? 'Remove from Library' : 'Add to Library' ?>
                                        </button>
                                    </form>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endif ?>
                <?php endforeach ?>
            </div>
        </div>
    </section>



</main>

<?php
include_once("./../pages/footer.php");
?>