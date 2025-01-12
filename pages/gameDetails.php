<?php require_once("./../pages/header.php") ?>

<div class="game-page max-w-7xl mx-auto p-4 md:p-6">
    <div class="relative mb-6">
        <img src="<?= $game_img ?>" alt="Game Banner" class="w-full h-[50vh] object-cover rounded-xl">
        <div class="absolute bottom-0 left-0 right-0 p-6 bg-gradient-to-t from-[var(--background)] to-transparent">
            <h2 class="text-3xl font-bold mb-2"><?= $game_name ?></h2>
            <div class="flex items-center gap-2">
                <span class="text-yellow-400">★</span>
                <span class="text-lg"><?= $rating ?>/100</span>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
        <img src="<?= $url_1 ?>" alt="Game Screenshot" class="w-full h-60 object-cover rounded-lg hover:opacity-90 transition-all">
        <img src="<?= $url_2 ?>" alt="Game Screenshot" class="w-full h-60 object-cover rounded-lg hover:opacity-90 transition-all">
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="lg:col-span-2 bg-[var(--secondary)] p-6 rounded-lg flex flex-col justify-between">
            <div>
                <p class="text-lg mb-6"><?= htmlspecialchars($game_desc) ?></p>
                <br>
                <div class="grid grid-cols-2 gap-4 mb-6">
                    <div>
                        <p class="mb-2"><span class="font-semibold">Release Date:</span> <?= $release_date ?></p>
                        <p><span class="font-semibold">Developer:</span> <?= $developer ?></p>
                    </div>
                    <div>
                        <p class="mb-2"><span class="font-semibold">Publisher:</span> <?= $publisher ?></p>
                        <p class="flex items-center">
                            <span class="inline-block bg-white p-1 rounded">
                                <img src="https://logodix.com/logo/2197892.png" alt="Metacritic Logo" class="h-10 w-10">
                            </span>
                            <span class="ml-2 text-white"><?= $rating ?>/100</span>
                        </p>
                    </div>
                </div>
            </div>
            <?php
            $isInLibrary = false;
            if (isset($_SESSION['user_id'])) {
                $isInLibrary = $this->isGameInLibrary($_SESSION['user_id'], $game_id);
            }
            ?>
            <form action="./../controllers/gameController.php?action=<?= $isInLibrary ? 'removeFromLibrary' : 'addToLibrary' ?>" method="POST" class="flex gap-2">
                <?php if (isset($_SESSION['user_id'])): ?>
                    <input type="hidden" name="game_id" value="<?= $game_id ?>">
                    <button type="submit" class="px-8 py-4 text-lg bg-[var(--primary)] text-white rounded-lg hover:bg-[var(--accent)] transition-colors">
                        <?= $isInLibrary ? 'Remove from Library' : 'Add to Library' ?>
                    </button>
                <?php else: ?>
                    <div class="flex-1 p-3 rounded-lg bg-yellow-100 text-yellow-800 border border-yellow-300 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="h-5 w-5 mr-2 fill-current text-yellow-800">
                            <path d="M501.362 383.95 320.497 51.474c-29.059-48.921-99.896-48.986-128.994 0L10.647 383.95c-29.706 49.989 6.259 113.291 64.482 113.291h361.736c58.174 0 94.203-63.251 64.497-113.291zM256 437.241c-16.538 0-30-13.462-30-30s13.462-30 30-30 30 13.462 30 30-13.462 30-30 30zm30-120c0 16.538-13.462 30-30 30s-30-13.462-30-30v-150c0-16.538 13.462-30 30-30s30 13.462 30 30v150z" />
                        </svg>
                        Please log in to add to your library
                    </div>
                <?php endif; ?>
            </form>
        </div>

        <div class="bg-[var(--secondary)] p-6 rounded-lg">
            <h3 class="text-xl font-bold mb-4">Reviews & Comments</h3>

            <form action="#" method="POST" class="mb-6">
                <?php if (isset($_SESSION['user_id'])): ?>
                    <textarea
                        name="comment"
                        class="w-full p-4 mb-3 rounded-lg bg-[var(--background)] border border-[var(--accent)]"
                        placeholder="Write your review..."
                        rows="4"></textarea>

                    <select name="rating" class="w-full p-3 mb-3 rounded-lg bg-[var(--background)] border border-[var(--accent)]">
                        <option value="" disabled selected>Rate the Game</option>
                        <option value="★★★★★">★★★★★ Excellent</option>
                        <option value="★★★★☆">★★★★☆ Very Good</option>
                        <option value="★★★☆☆">★★★☆☆ Good</option>
                        <option value="★★☆☆☆">★★☆☆☆ Fair</option>
                        <option value="★☆☆☆☆">★☆☆☆☆ Poor</option>
                    </select>

                    <button type="submit" class="w-full py-3 bg-[var(--primary)] text-white rounded-lg hover:bg-[var(--accent)] transition-colors">
                        Submit Review
                    </button>
                <?php else: ?>
                    <div class="w-full p-4 mb-3 rounded-lg bg-yellow-100 text-yellow-800 border border-yellow-300 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="h-5 w-5 mr-2 fill-current text-yellow-800">
                            <path d="M501.362 383.95 320.497 51.474c-29.059-48.921-99.896-48.986-128.994 0L10.647 383.95c-29.706 49.989 6.259 113.291 64.482 113.291h361.736c58.174 0 94.203-63.251 64.497-113.291zM256 437.241c-16.538 0-30-13.462-30-30s13.462-30 30-30 30 13.462 30 30-13.462 30-30 30zm30-120c0 16.538-13.462 30-30 30s-30-13.462-30-30v-150c0-16.538 13.462-30 30-30s30 13.462 30 30v150z" />
                        </svg>
                        Please log in to submit a review
                    </div>
                <?php endif; ?>
            </form>

            <div class="space-y-4 max-h-[400px] overflow-y-auto custom-scrollbar">
                <?php foreach ($reviews as $review):
                    extract($review); ?>
                    <div class="bg-[var(--background)] p-4 rounded-lg">
                        <div class="flex justify-between mb-2">
                            <h4 class="font-bold"><?= $full_name ?></h4>
                            <span class="text-yellow-400"><?= $rating_review ?></span>
                        </div>
                        <p class="text-sm"><?= $review_desc ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    <div class="mt-6 bg-[var(--secondary)] p-6 rounded-lg">
        <h3 class="text-xl font-bold mb-4">Live Chat</h3>

        <div class="bg-[var(--background)] rounded-lg p-4 mb-4 h-[300px] overflow-y-auto custom-scrollbar">
            <div class="space-y-4">
                <?php foreach ($chat_data as $row):
                    extract($row); ?>
                    <div class="message">
                        <p class="text-sm font-bold text-[var(--accent)]"><?= $full_name ?>:</p>
                        <p class="text-sm ml-4 mt-1"><?= $message ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <form action="#" method="POST" class="flex gap-2">
            <?php if (isset($_SESSION['user_id'])): ?>
                <input
                    type="text"
                    name="message"
                    class="flex-1 p-3 rounded-lg bg-[var(--background)] border border-[var(--accent)]"
                    placeholder="Type a message...">
                <button type="submit" class="px-6 bg-[var(--primary)] text-white rounded-lg hover:bg-[var(--accent)] transition-colors">
                    Send
                </button>
            <?php else: ?>
                <div class="flex-1 p-3 rounded-lg bg-yellow-100 text-yellow-800 border border-yellow-300 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="h-5 w-5 mr-2 fill-current text-yellow-800">
                        <path d="M501.362 383.95 320.497 51.474c-29.059-48.921-99.896-48.986-128.994 0L10.647 383.95c-29.706 49.989 6.259 113.291 64.482 113.291h361.736c58.174 0 94.203-63.251 64.497-113.291zM256 437.241c-16.538 0-30-13.462-30-30s13.462-30 30-30 30 13.462 30 30-13.462 30-30 30zm30-120c0 16.538-13.462 30-30 30s-30-13.462-30-30v-150c0-16.538 13.462-30 30-30s30 13.462 30 30v150z" />
                    </svg>
                    Please log in to send a message
                </div>
            <?php endif; ?>
        </form>
    </div>
</div>


<?php require_once("./../pages/footer.php") ?>