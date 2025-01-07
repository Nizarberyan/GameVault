<?php if (session_status() === PHP_SESSION_NONE) session_start(); ?>
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
                    <li><a href="./../pages/home.php" class="hover:underline">Home</a></li>
                    <li><a href="library.php" class="hover:underline">Library</a></li>
                    <li><a href="./../controllers/userController.php?action=on" class="hover:underline">Profile</a></li>
                    <?php if (isset($_SESSION['role']) && $_SESSION['role'] == "admin"): ?>
                        <li><a href="./../controllers/userController.php" class="hover:underline">Dashboard</a></li>
                    <?php endif; ?>
                </ul>
            </nav>
        </div>
    </header>

    <?php if (isset($_SESSION['Error'])): ?>
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
            <strong class="font-bold">Error: </strong>
            <span class="block sm:inline"><?= htmlspecialchars($_SESSION['Message']); ?></span>
            <button type="button" class="absolute top-0 bottom-0 right-0 px-4 py-3" onclick="this.parentElement.style.display='none';">
                <svg class="fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                    <title></title>
                    <path d="M14.348 5.652a1 1 0 011.415 0l.086.086a1 1 0 010 1.415L11.415 11l4.434 4.434a1 1 0 01-1.415 1.415L10 12.415l-4.434 4.434a1 1 0 01-1.415-1.415L8.585 11 4.152 6.566a1 1 0 011.415-1.415L10 9.585l4.348-4.348z" />
                </svg>
            </button>
        </div>
    <?php
        unset($_SESSION['Error']);
        unset($_SESSION['Message']);
    endif; ?>
    <?php if (isset($_SESSION['Success'])): ?>
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
            <strong class="font-bold">Success: </strong>
            <span class="block sm:inline"><?= htmlspecialchars($_SESSION['Message']); ?></span>
            <button type="button" class="absolute top-0 bottom-0 right-0 px-4 py-3" onclick="this.parentElement.style.display='none';">
                <svg class="fill-current h-6 w-6 text-green-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                    <title>Close</title>
                    <path d="M14.348 5.652a1 1 0 011.415 0l.086.086a1 1 0 010 1.415L11.415 11l4.434 4.434a1 1 0 01-1.415 1.415L10 12.415l-4.434 4.434a1 1 0 01-1.415-1.415L8.585 11 4.152 6.566a1 1 0 011.415-1.415L10 9.585l4.348-4.348z" />
                </svg>
            </button>
        </div>
    <?php
        unset($_SESSION['Success']);
        unset($_SESSION['Message']);
    endif; ?>