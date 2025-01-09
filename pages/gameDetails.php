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
                        <p><span class="font-semibold">Rating:</span> <?= $rating ?>/100</p>
                    </div>
                </div>
            </div>

            <div>
                <button class="w-full lg:w-auto px-6 py-3 bg-[var(--primary)] text-white rounded-lg hover:bg-[var(--accent)] transition-colors">
                    Add to Your Library
                </button>
            </div>
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
                        <option value="5">★★★★★ Excellent</option>
                        <option value="4">★★★★☆ Very Good</option>
                        <option value="3">★★★☆☆ Good</option>
                        <option value="2">★★☆☆☆ Fair</option>
                        <option value="1">★☆☆☆☆ Poor</option>
                    </select>

                    <button type="submit" class="w-full py-3 bg-[var(--primary)] text-white rounded-lg hover:bg-[var(--accent)] transition-colors">
                        Submit Review
                    </button>
                <?php else: ?>
                    <div class="w-full p-4 mb-3 rounded-lg bg-[var(--background)] border border-[var(--accent)] text-gray-500">
                        Please log in to submit a review
                    </div>
                <?php endif; ?>
            </form>

            <div class="space-y-4 max-h-[400px] overflow-y-auto custom-scrollbar">
                <div class="bg-[var(--background)] p-4 rounded-lg">
                    <div class="flex justify-between mb-2">
                        <h4 class="font-bold">User123</h4>
                        <span class="text-yellow-400">★★★★★</span>
                    </div>
                    <p class="text-sm">This game is amazing! I love the graphics and gameplay.</p>
                </div>
                <div class="bg-[var(--background)] p-4 rounded-lg">
                    <div class="flex justify-between mb-2">
                        <h4 class="font-bold">User123</h4>
                        <span class="text-yellow-400">★★★★★</span>
                    </div>
                    <p class="text-sm">This game is amazing! I love the graphics and gameplay.</p>
                </div>
                <div class="bg-[var(--background)] p-4 rounded-lg">
                    <div class="flex justify-between mb-2">
                        <h4 class="font-bold">User123</h4>
                        <span class="text-yellow-400">★★★★★</span>
                    </div>
                    <p class="text-sm">This game is amazing! I love the graphics and gameplay.</p>
                </div>
                <div class="bg-[var(--background)] p-4 rounded-lg">
                    <div class="flex justify-between mb-2">
                        <h4 class="font-bold">User123</h4>
                        <span class="text-yellow-400">★★★★★</span>
                    </div>
                    <p class="text-sm">This game is amazing! I love the graphics and gameplay.</p>
                </div>
                <div class="bg-[var(--background)] p-4 rounded-lg">
                    <div class="flex justify-between mb-2">
                        <h4 class="font-bold">Gamer456</h4>
                        <span class="text-yellow-400">★★★★</span>
                    </div>
                    <p class="text-sm">Pretty solid game, but some bugs need fixing.</p>
                </div>
                <div class="bg-[var(--background)] p-4 rounded-lg">
                    <div class="flex justify-between mb-2">
                        <h4 class="font-bold">Player789</h4>
                        <span class="text-yellow-400">★★★★★</span>
                    </div>
                    <p class="text-sm">Fantastic! One of the best games I've played this year.</p>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-6 bg-[var(--secondary)] p-6 rounded-lg">
        <h3 class="text-xl font-bold mb-4">Live Chat</h3>

        <div class="bg-[var(--background)] rounded-lg p-4 mb-4 h-[300px] overflow-y-auto custom-scrollbar">
            <div class="space-y-4">
                <div class="message">
                    <p class="text-sm font-bold text-[var(--accent)]">User789:</p>
                    <p class="text-sm ml-4 mt-1">Anyone else excited for the next update?</p>
                </div>
                <div class="message">
                    <p class="text-sm font-bold text-[var(--accent)]">User789:</p>
                    <p class="text-sm ml-4 mt-1">Anyone else excited for the next update?</p>
                </div>
                <div class="message">
                    <p class="text-sm font-bold text-[var(--accent)]">User789:</p>
                    <p class="text-sm ml-4 mt-1">Anyone else excited for the next update?</p>
                </div>
                <div class="message">
                    <p class="text-sm font-bold text-[var(--accent)]">User789:</p>
                    <p class="text-sm ml-4 mt-1">Anyone else excited for the next update?</p>
                </div>
                <div class="message">
                    <p class="text-sm font-bold text-[var(--accent)]">User789:</p>
                    <p class="text-sm ml-4 mt-1">Anyone else excited for the next update?</p>
                </div>
                <div class="message">
                    <p class="text-sm font-bold text-[var(--accent)]">User789:</p>
                    <p class="text-sm ml-4 mt-1">Anyone else excited for the next update?</p>
                </div>
                <div class="message">
                    <p class="text-sm font-bold text-[var(--accent)]">User789:</p>
                    <p class="text-sm ml-4 mt-1">Anyone else excited for the next update?</p>
                </div>
                <div class="message">
                    <p class="text-sm font-bold text-[var(--accent)]">Gamer123:</p>
                    <p class="text-sm ml-4 mt-1">Yes! I hope they fix the multiplayer lag.</p>
                </div>
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
                <div class="flex-1 p-3 rounded-lg bg-[var(--background)] border border-[var(--accent)] text-gray-500">
                    Please log in to send a message
                </div>
            <?php endif; ?>
        </form>
    </div>
</div>


<?php require_once("./../pages/footer.php") ?>