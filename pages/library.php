<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library - Game Collection Platform</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        :root {
            --text: #F8F9FA;
            --background: #0A0A0B;
            --primary: #9333EA;
            --secondary: #1F1F23;
            --accent: #A855F7;
        }
        body {
            background-color: var(--background);
            color: var(--text);
        }
    </style>
</head>
<body class="text-[var(--text)] bg-[var(--background)]">
    <header class="bg-[var(--primary)] text-white p-4">
        <div class="container mx-auto flex justify-between items-center">
            <h1 class="text-2xl font-bold">Game Library</h1>
            <nav>
                <ul class="flex space-x-4">
                    <li><a href="index.php" class="hover:underline">Home</a></li>
                    <li><a href="chat.php" class="hover:underline">Chat</a></li>
                    <li><a href="profile.php" class="hover:underline">Profile</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <main class="container mx-auto my-8 space-y-8">
        <section class="bg-[var(--secondary)] p-6 rounded shadow">
            <h2 class="text-xl font-bold mb-4">Your Favorite Games</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                <?php
                    // Fetch favorited games from the database
                    // Example PHP code:
                    // $favoritedGames = fetchFavoritedGamesForUser($userId);
                    // foreach ($favoritedGames as $game) {
                    //     echo "<div class='bg-[var(--background)] p-4 rounded shadow'>
                    //             <img src='{$game['cover']}' alt='{$game['title']}' class='w-full h-40 object-cover rounded mb-4'>
                    //             <h3 class='text-lg font-bold mb-2'>{$game['title']}</h3>
                    //             <p class='text-sm mb-2'>Genre: {$game['genre']}</p>
                    //             <p class='text-sm mb-2'>Rating: {$game['rating']}/10</p>
                    //             <p class='text-sm mb-2'>Status: {$game['status']}</p>
                    //         </div>";
                    // }
                ?>
            </div>
        </section>
    </main>

    <footer class="bg-[var(--secondary)] text-white py-4">
        <div class="container mx-auto text-center">
            <p>&copy; 2024 Game Collection Platform. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>
