<?php
// require '../GameVault/config/database.php';
// require '../GameVault/classes/game.php';

// // $api_key = '662FF0DF68DC133C1F3878E7BD87787A';  
// $game = new Game();
// $games_from_db = $game->getAllGames();

// $games_with_details = [];


// foreach ($games_from_db as $db_game) {
//     $steam_id = $db_game['steam_id'];


//     $steam_api_url = "https://store.steampowered.com/api/appdetails?appids={$steam_id}";
//     $response = file_get_contents($steam_api_url);
//     $data = json_decode($response, true);

//     if ($data && isset($data[$steam_id]['data'])) {
//         $game_details = $data[$steam_id]['data'];

//         $game = new Game();
//         $game->setTitle($db_game['title']);
//         $game->setSteamId($db_game['steam_id']);
//         $game->setDescription(isset($game_details['short_description']) ? $game_details['short_description'] : 'No description available.');
//         $game->setImage(isset($game_details['header_image']) ? $game_details['header_image'] : 'https://via.placeholder.com/150');
//         $game->setPrice(isset($game_details['price_overview']['final_formatted']) ? $game_details['price_overview']['final_formatted'] : 'Price not available');
//         $game->setReleaseDate(isset($game_details['release_date']['date']) ? $game_details['release_date']['date'] : 'Release date not available');
//         $game->setDeveloper(isset($game_details['developers']) ? implode(', ', $game_details['developers']) : 'Developer not available');
//         $game->setPublisher(isset($game_details['publishers']) ? implode(', ', $game_details['publishers']) : 'Publisher not available');

//         $games_with_details[] = $game;
//     }
// }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - Game Collection Platform</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="src/javascript/addGame.js" defer></script>
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
            <h1 class="text-2xl font-bold">Game Collection Platform</h1>
            <nav>
                <ul class="flex space-x-4">
                    <li><a href="index.php" class="hover:underline">Home</a></li>
                    <li><a href="library.php" class="hover:underline">Library</a></li>
                    <li><a href="chat.php" class="hover:underline">Chat</a></li>
                    <li><a href="profile.php" class="hover:underline">Profile</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <main class="container mx-auto my-8 space-y-8">
        <section class="bg-[var(--secondary)] p-6 rounded shadow">
            <h2 class="text-xl font-bold mb-4">Available Games</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                <?php foreach ($games_with_details as $game) { ?>
                    <div class='bg-[var(--background)] p-4 rounded shadow h-[500px] flex flex-col justify-between'>
                        <div>
                            <img src='<?php echo $game->getImage(); ?>' alt='<?php echo $game->getTitle(); ?>' class='w-full h-40 object-cover rounded mb-4'>
                            <h3 class='text-lg font-bold mb-2'><?php echo $game->getTitle(); ?></h3>
                            <p class='text-sm mb-4 line-clamp-3'><?php echo $game->getDescription(); ?></p>
                            <div class='text-sm'>
                                <p class='text-[var(--accent)]'>Price: <?php echo $game->getPrice(); ?></p>
                                <p>Release Date: <?php echo $game->getReleaseDate(); ?></p>
                                <p>Developer: <?php echo $game->getDeveloper(); ?></p>
                                <p>Publisher: <?php echo $game->getPublisher(); ?></p>
                            </div>
                        </div>
                        <form action='' method='POST'>
                            <input type='hidden' name='game_title' value='<?php echo $game->getTitle(); ?>'>
                            <button type='submit' class='w-full px-4 py-2 bg-[var(--primary)] text-white rounded hover:bg-[var(--accent)]'>Add to Library</button>
                        </form>
                    </div>
                <?php } ?>
            </div>
        </section>
        <!-- Add Game Button -->
        <button onclick="openModal()" class="fixed bottom-4 right-4 bg-[var(--primary)] text-white p-4 rounded-full shadow-lg hover:bg-[var(--accent)]">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
        </button>
    </main>
    <footer class="bg-[var(--secondary)] text-white py-4">
        <div class="container mx-auto text-center">
            <p>&copy; 2024 Game Collection Platform. All rights reserved.</p>
        </div>
    </footer>
</body>

</html>



<!-- Add Game Modal -->
<div id="addGameModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center">
    <div class="bg-[var(--secondary)] p-6 rounded-lg w-full max-w-md">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-bold">Add New Game</h2>
            <button onclick="closeModal()" class="text-gray-500 hover:text-white">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
        <form action="" method="POST" class="space-y-4">
        <div>
                <label class="block text-sm font-medium mb-1">Title</label>
                <div class="flex gap-2">
                    <input type="text" name="Title" id="title" required class="w-full p-2 rounded bg-[var(--background)] text-white">
                    <button type="button" id="AutoFill"class="px-4 py-2 bg-[var(--primary)] text-white rounded hover:bg-[var(--accent)]">
                        Auto Fill
                    </button>
            
                </div>
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">Description</label>
                <textarea name="description" id="description" class="w-full p-2 rounded bg-[var(--background)] text-white"></textarea>
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">Image URL</label>
                <input type="url" name="image" id="image" required class="w-full p-2 rounded bg-[var(--background)] text-white">
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">Release Date</label>
                <input type="date" name="release_date" id="release_date" required class="w-full p-2 rounded bg-[var(--background)] text-white">
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">Developer</label>
                <input type="text" name="developer" id="developer" required class="w-full p-2 rounded bg-[var(--background)] text-white">
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">Publisher</label>
                <input type="text" name="publisher" id="publisher" required class="w-full p-2 rounded bg-[var(--background)] text-white">
            </div>
            <button type="submit" id="addGame" class="w-full bg-[var(--primary)] text-white py-2 rounded hover:bg-[var(--accent)]">Add Game</button>
        </form>
    </div>
</div>

<script>
    function openModal() {
        document.getElementById('addGameModal').classList.remove('hidden');
    }

    function closeModal() {
        document.getElementById('addGameModal').classList.add('hidden');
    }
</script>