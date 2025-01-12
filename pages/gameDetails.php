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

                        <p class="mb-4"><span class="font-semibold">GameVault Rating:</span> <?= number_format($totalPoints / $divisor, 1) ?>/100</p>
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
                <?php elseif ($_SESSION['is_banned'] === 1): ?>
                    <div class="flex-1 p-3 rounded-lg bg-yellow-100 text-yellow-800 border border-yellow-300 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="h-5 w-5 mr-2 fill-current text-yellow-800">
                            <path d="M501.362 383.95 320.497 51.474c-29.059-48.921-99.896-48.986-128.994 0L10.647 383.95c-29.706 49.989 6.259 113.291 64.482 113.291h361.736c58.174 0 94.203-63.251 64.497-113.291zM256 437.241c-16.538 0-30-13.462-30-30s13.462-30 30-30 30 13.462 30 30-13.462 30-30 30zm30-120c0 16.538-13.462 30-30 30s-30-13.462-30-30v-150c0-16.538 13.462-30 30-30s30 13.462 30 30v150z" />
                        </svg>
                        You are currently Banned
                    </div>
                <?php else: ?>
                    <form action='' method='POST'>
                        <input type='hidden' name='game_title' value=''>
                        <button type='submit' class='w-full px-4 py-2 bg-[var(--primary)] text-white rounded hover:bg-[var(--accent)]'>Add to Library</button>
                    </form>
                <?php endif; ?>
            </div>
        </div>

        <div class="bg-[var(--secondary)] p-6 rounded-lg">
            <h3 class="text-xl font-bold mb-4">Reviews & Comments</h3>
            <div>
                <?php if (!isset($_SESSION['user_id'])): ?>
                    <div class="w-full p-4 mb-5 rounded-lg bg-yellow-100 text-yellow-800 border border-yellow-300 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="h-5 w-5 mr-2 fill-current text-yellow-800">
                            <path d="M501.362 383.95 320.497 51.474c-29.059-48.921-99.896-48.986-128.994 0L10.647 383.95c-29.706 49.989 6.259 113.291 64.482 113.291h361.736c58.174 0 94.203-63.251 64.497-113.291zM256 437.241c-16.538 0-30-13.462-30-30s13.462-30 30-30 30 13.462 30 30-13.462 30-30 30zm30-120c0 16.538-13.462 30-30 30s-30-13.462-30-30v-150c0-16.538 13.462-30 30-30s30 13.462 30 30v150z" />
                        </svg>
                        Please log in to submit a review
                    </div>
                <?php elseif ($_SESSION['is_banned'] === 1): ?>
                    <div class="flex-1 p-3 mb-5 rounded-lg bg-yellow-100 text-yellow-800 border border-yellow-300 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="h-5 w-5 mr-2 fill-current text-yellow-800">
                            <path d="M501.362 383.95 320.497 51.474c-29.059-48.921-99.896-48.986-128.994 0L10.647 383.95c-29.706 49.989 6.259 113.291 64.482 113.291h361.736c58.174 0 94.203-63.251 64.497-113.291zM256 437.241c-16.538 0-30-13.462-30-30s13.462-30 30-30 30 13.462 30 30-13.462 30-30 30zm30-120c0 16.538-13.462 30-30 30s-30-13.462-30-30v-150c0-16.538 13.462-30 30-30s30 13.462 30 30v150z" />
                        </svg>
                        You are currently Banned
                    </div>
                <?php else: ?>
                    <form action="./../controllers/gameController.php?action=reviewSubmit" method="POST" id="myForm" class="mb-6">
                        <input type="hidden" name="game_id" value="<?= $game_id ?>">
                        <textarea
                            name="comment"
                            class="w-full p-4 mb-3 rounded-lg bg-[var(--background)] border border-[var(--accent)]"
                            placeholder="Write your review..."
                            rows="4"></textarea>

                        <select name="rating" id="rating" class="w-full p-3 mb-3 rounded-lg bg-[var(--background)] border border-[var(--accent)]">
                            <option value="" disabled selected>Rate the Game</option>
                            <option value="★★★★★" data-extra="100">★★★★★ Excellent</option>
                            <option value="★★★★☆" data-extra="80">★★★★☆ Very Good</option>
                            <option value="★★★☆☆" data-extra="60">★★★☆☆ Good</option>
                            <option value="★★☆☆☆" data-extra="40">★★☆☆☆ Fair</option>
                            <option value="★☆☆☆☆" data-extra="20">★☆☆☆☆ Poor</option>
                        </select>
                        <input type="hidden" name="rating_value" id="rating_value">

                        <button type="submit" class="w-full py-3 bg-[var(--primary)] text-white rounded-lg hover:bg-[var(--accent)] transition-colors">
                            Submit Review
                        </button>
                    </form>
                <?php endif; ?>
            </div>
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

    <div class="mt-6 bg-[var(--secondary)] p-6 rounded-lg relative">
        <h3 class="text-xl font-bold mb-4">Live Chat</h3>

        <div id="scroller" class="bg-[var(--background)] rounded-lg p-4 mb-4 h-[300px] overflow-y-auto custom-scrollbar">
            <div class="absolute top-3 right-3 cursor-pointer" id="refresh">
                <svg width="30px" height="30px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M3 3V8M3 8H8M3 8L6 5.29168C7.59227 3.86656 9.69494 3 12 3C16.9706 3 21 7.02944 21 12C21 16.9706 16.9706 21 12 21C7.71683 21 4.13247 18.008 3.22302 14" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </div>
            <div class="space-y-4" id="msgs_container">
                <?php foreach ($chat_data as $row):
                    extract($row); ?>
                    <div class="message">
                        <p class="text-sm font-bold text-[var(--accent)]"><?= $full_name ?>:</p>
                        <p id="content" class="text-sm ml-4 mt-1"><?= $message ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <?php if (!isset($_SESSION['user_id'])): ?>
            <div class="w-full p-4 mb-5 rounded-lg bg-yellow-100 text-yellow-800 border border-yellow-300 flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="h-5 w-5 mr-2 fill-current text-yellow-800">
                    <path d="M501.362 383.95 320.497 51.474c-29.059-48.921-99.896-48.986-128.994 0L10.647 383.95c-29.706 49.989 6.259 113.291 64.482 113.291h361.736c58.174 0 94.203-63.251 64.497-113.291zM256 437.241c-16.538 0-30-13.462-30-30s13.462-30 30-30 30 13.462 30 30-13.462 30-30 30zm30-120c0 16.538-13.462 30-30 30s-30-13.462-30-30v-150c0-16.538 13.462-30 30-30s30 13.462 30 30v150z" />
                </svg>
                Please log in to chat in
            </div>
        <?php elseif ($_SESSION['is_banned'] === 1): ?>
            <div class="flex-1 p-3 mb-5 rounded-lg bg-yellow-100 text-yellow-800 border border-yellow-300 flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="h-5 w-5 mr-2 fill-current text-yellow-800">
                    <path d="M501.362 383.95 320.497 51.474c-29.059-48.921-99.896-48.986-128.994 0L10.647 383.95c-29.706 49.989 6.259 113.291 64.482 113.291h361.736c58.174 0 94.203-63.251 64.497-113.291zM256 437.241c-16.538 0-30-13.462-30-30s13.462-30 30-30 30 13.462 30 30-13.462 30-30 30zm30-120c0 16.538-13.462 30-30 30s-30-13.462-30-30v-150c0-16.538 13.462-30 30-30s30 13.462 30 30v150z" />
                </svg>
                You are currently Banned
            </div>
        <?php else: ?>
            <form id="chatForm" method="POST" class="flex gap-2">
                <input type="hidden" name="game_id" id="game_id" value="<?= $game_id ?>">
                <input type="hidden" name="user_id" id="user_id" value="<?= $_SESSION['user_id'] ?>">
                <input
                    type="text"
                    name="message"
                    id="message"
                    class="flex-1 p-3 rounded-lg bg-[var(--background)] border border-[var(--accent)]"
                    placeholder="Type a message...">
                <button class="px-6 bg-[var(--primary)] text-white rounded-lg hover:bg-[var(--accent)] transition-colors">
                    Send
                </button>
            </form>
        <?php endif; ?>
    </div>
</div>


<?php require_once("./../pages/footer.php") ?>

<script defer>
    const container = document.querySelector('#scroller');

    container.scrollTo({
        top: container.scrollHeight,
        behavior: 'smooth'
    });
    document.addEventListener("DOMContentLoaded", function() {
        let chatForm = document.querySelector("#chatForm");
        let message = chatForm.querySelector("#message");
        let user_id = chatForm.querySelector("#user_id");
        let game_id = chatForm.querySelector("#game_id");

        chatForm.addEventListener("submit", function(event) {
            event.preventDefault();

            var xhttp = new XMLHttpRequest();

            xhttp.onreadystatechange = function() {
                if (this.readyState === 4 && this.status === 200) {
                    console.log("Message send successfuly");
                    message.value = "";
                    getRequest();
                }
            };

            xhttp.open('POST', './../Classes/liveChat.php', true);
            xhttp.setRequestHeader('Content-type', 'application/json; charset=utf-8');
            xhttp.send(JSON.stringify({
                message: message.value,
                user_id: user_id.value,
                game_id: game_id.value
            }));
        });

        function getRequest() {
            const xhttp = new XMLHttpRequest();
            xhttp.open('GET', `./../Classes/liveChat.php?id=${game_id.value}`, true);
            xhttp.setRequestHeader('Content-type', 'application/json; charset=utf-8');


            xhttp.onload = function() {
                if (xhttp.status === 200) {
                    console.log('NewMessage');
                } else {
                    console.error('Error');
                }
            };
            xhttp.onreadystatechange = function() {
                if (this.readyState === 4 && this.status === 200) {
                    var messages = JSON.parse(xhttp.response);
                    document.querySelector("#msgs_container").innerHTML = '';
                    messages.slice().reverse().forEach(e => {
                        var messageTemplate = `<div class="message">
                                                    <p class="text-sm font-bold text-[var(--accent)]">${e.full_name}</p>
                                                    <p class="text-sm ml-4 mt-1">${e.message}</p>
                                                </div>`;
                        document.querySelector("#msgs_container").innerHTML += messageTemplate;
                        container.scrollTo({
                            top: container.scrollHeight,
                            behavior: 'smooth'
                        });
                    });
                }
            };

            xhttp.onerror = function() {
                console.error('Request failed.');
            };

            xhttp.send();
        }
        document.querySelector("#refresh").addEventListener("click", () => {
            getRequest();
        });

    });
</script>