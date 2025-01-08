<?php require_once("./../pages/header.php") ?>

<div class="game-page bg-[var(--background)] p-6 rounded shadow">
    <div class="game-details">
        <div class="game-header mb-6">
            <img src="./../assets/67793c09a598a.jpg" alt="Game Banner" class="w-full h-[40vh] object-cover rounded">
        </div>
        <div class="game-screenshot w-full lg:w-full flex gap-5 items-center justify-center">
            <img src="https://via.placeholder.com/400x300" alt="Game Screenshot" class="w-full h-60 object-cover rounded">
            <img src="https://via.placeholder.com/400x300" alt="Game Screenshot" class="w-full h-60 object-cover rounded">
        </div>
        <div class="flex flex-col lg:flex-row gap-6">
            <div class="flex-1">
                <h2 class="text-2xl font-bold mb-2">Game Title</h2>
                <p class="text-sm mb-4">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus euismod, erat non hendrerit mollis, enim
                    lectus efficitur lorem, id fringilla tortor ligula id nunc. Integer condimentum tortor et felis vehicula, vel
                    bibendum metus aliquam.
                </p>
                <div class="text-sm space-y-2">
                    <p><strong>Rating:</strong> 95/100</p>
                    <p><strong>Release Date:</strong> January 5, 2025</p>
                    <p><strong>Developer:</strong> Game Dev Studios</p>
                    <p><strong>Publisher:</strong> Game Pub Inc.</p>
                </div>
                <button class="w-full lg:w-auto px-4 py-2 mt-4 bg-[var(--primary)] text-white rounded hover:bg-[var(--accent)]">
                    Add to Your Library
                </button>
            </div>
        </div>
    </div>

    <div class="reviews mt-8 bg-[var(--secondary)] p-4 rounded">
        <h3 class="text-xl font-bold mb-4">Reviews & Comments</h3>
        <form action="#" method="POST" class="mb-4">
            <textarea name="comment" class="w-full p-2 border rounded mb-2 text-[var(--secondary)]" placeholder="Write your review..." rows="4"></textarea>
            <select name="rating" class="w-full p-2 border rounded mb-2 bg-[var(--secondary)]">
                <option value="" disabled selected>Rate the Game</option>
                <option value="1">1 - Terrible</option>
                <option value="2">2 - Poor</option>
                <option value="3">3 - Average</option>
                <option value="4">4 - Good</option>
                <option value="5">5 - Excellent</option>
            </select>
            <button type="submit" class="w-full px-4 py-2 bg-[var(--primary)] text-white rounded hover:bg-[var(--accent)]">
                Submit Review
            </button>
        </form>
        <div class="review-list space-y-4 bg-[var(--accent)] p-4 h-60 overflow-y-scroll rounded scrollbar-0">
            <div class="review p-4 rounded bg-[var(--background)] text-[var(--text)]">
                <p class="text-sm font-bold">User123 <span class="text-[var(--primary)]">⭐⭐⭐⭐⭐</span></p>
                <p class="text-sm">This game is amazing! I love the graphics and gameplay.</p>
            </div>
            <div class="review p-4 rounded bg-[var(--background)] text-[var(--text)]">
                <p class="text-sm font-bold">Gamer456 <span class="text-[var(--primary)]">⭐⭐⭐⭐</span></p>
                <p class="text-sm">Pretty solid game, but some bugs need fixing.</p>
            </div>
            <div class="review p-4 rounded bg-[var(--background)] text-[var(--text)]">
                <p class="text-sm font-bold">Player789 <span class="text-[var(--primary)]">⭐⭐⭐⭐⭐</span></p>
                <p class="text-sm">Fantastic! One of the best games I’ve played this year.</p>
            </div>
            <div class="review p-4 rounded bg-[var(--background)] text-[var(--text)]">
                <p class="text-sm font-bold">GamerGirl42 <span class="text-[var(--primary)]">⭐⭐⭐</span></p>
                <p class="text-sm">Good game, but it needs more content and better optimization.</p>
            </div>
        </div>

    </div>

    <div class="live-chat mt-8 p-4 rounded bg-[var(--secondary)] text-[var(--text)]">
        <h3 class="text-xl font-bold mb-4">Live Chat</h3>
        <div class="chat-messages mb-4 h-60 overflow-y-scroll p-2 rounded bg-[var(--primary)]">
            <div class="message mb-2">
                <p class="text-sm font-bold">User789:</p>
                <p class="text-sm">Anyone else excited for the next update?</p>
            </div>
            <div class="message mb-2">
                <p class="text-sm font-bold">Gamer123:</p>
                <p class="text-sm">Yes! I hope they fix the multiplayer lag.</p>
            </div>
        </div>
        <form action="#" method="POST" class="flex">
            <input type="text" name="message" class="flex-1 p-2 border rounded-l" placeholder="Type a message...">
            <button type="submit" class="px-4 bg-[var(--primary)] text-white rounded-r hover:bg-[var(--accent)]">
                Send
            </button>
        </form>
    </div>
</div>


<?php require_once("./../pages/footer.php") ?>