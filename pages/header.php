<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - Game Collection Platform</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="./../src/javascript/addGame.js" defer></script>
    <script src="./../src/javascript/script.js" defer></script>
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
                    <li><a href="./../controllers/userController.php?action=on" class="hover:underline">Profile</a></li>
                </ul>
            </nav>
        </div>
    </header>