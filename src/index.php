<?php
session_start();

$page = isset($_GET['page']) ? $_GET['page'] : 'home';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GameVault</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        :root {
            --text: #F8F9FA;
            --background: #0A0A0B;
            --primary: #9333EA;
            --secondary: #1F1F23;
            --accent: #A855F7;
        }
    </style>
    <link rel="stylesheet" href="css/style.css">
</head>

<body class="bg-[var(--background)] text-[var(--text)] min-h-screen flex items-center justify-center">
    <?php
    switch ($page) {
        case 'login':
            include 'pages/login.php';
            break;
        case 'signup':
            include 'pages/signup.php';
            break;
        case 'dashboard':
            include 'pages/dashboard.php';
            break;
        default:
            include 'pages/home.php';
    }
    ?>
</body>

</html>