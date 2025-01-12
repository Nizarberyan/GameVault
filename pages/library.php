<?php require_once("./../pages/header.php") ?>

<div class="container mx-auto min-h-[90vh] p-5">
    <h2 class="text-2xl font-bold mb-6">My Library</h2>
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
        <?php if (!empty($library)): ?>
            <?php foreach ($library as $game): ?>
                <div class='bg-[var(--secondary)] p-4 rounded shadow h-[500px] flex flex-col justify-between'>
                    <a href="./../controllers/gameController.php?action=gameDetails&id=<?= $game['game_id'] ?>" class="flex-grow">
                        <div>
                            <img src='<?= $game['game_img'] ?>' alt='' class='w-full h-40 object-cover rounded mb-4'>
                            <h3 class='text-lg font-bold mb-2'><?= $game['game_name'] ?></h3>
                            <p class='text-sm mb-4 line-clamp-3'><?= substr($game['game_desc'], 0, 130) . "..." ?></p>
                            <div class='text-sm'>
                                <p>Rating: <?= $game['rating'] . "/100" ?></p>
                                <p>Release Date: <?= $game['release_date'] ?></p>
                                <p>Developer: <?= $game['developer'] ?></p>
                                <p>Publisher: <?= $game['publisher'] ?></p>
                            </div>
                        </div>
                    </a>
                    <form action="./../controllers/gameController.php?action=removeFromLibrary" method="POST" class="mt-4">
                        <input type='hidden' name='game_id' value='<?= $game['game_id'] ?>'>
                        <button type='submit' class='w-full px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700'>
                            Remove from Library
                        </button>
                    </form>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p class="text-lg">Your library is empty. Start adding some games!</p>
        <?php endif; ?>
    </div>
</div>

<?php require_once("./../pages/footer.php") ?>