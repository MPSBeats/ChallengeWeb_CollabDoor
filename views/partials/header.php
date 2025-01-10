<?php
session_start();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/assets/css/main.css">
    <script src="https://unpkg.com/lenis@1.1.18/dist/lenis.min.js"></script>
    <title>Document</title>
</head>

<body>
    <header>
        <nav>
            <a href="index.php?page=home">
                <img src="/assets/img/IconCollabdoor.svg" alt="logo" >
            </a>
            <button class="c-header_nav_burger" data-header="burger" hidden></button>
            <ul class="collaborate">
                <li><a href="index.php?page=collaborate">
                        <h3>Collaborer</h3>
                    </a></li>
                <li><a href="index.php?page=discover">
                        <h3>Découvrir</h3>
                    </a></li>
                <li><a href="index.php?page=learn">
                        <h3>Apprendre</h3>
                    </a></li>
            </ul>
            <?php if (isset($_SESSION['pseudo'])): ?>
                <?php
                // Example profile data from session or database
                $profile = [
                    'pseudo' => $_SESSION['pseudo'],
                    'email' => $_SESSION['email'] ?? 'example@example.com', // Replace with actual session keys
                    'age' => $_SESSION['age'] ?? 25 // Replace with actual session keys
                ];
                ?>
                <ul class="user">
                    <li><a href="index.php?page=profile">
                            <button>
                                <h3>Profile</h3>
                            </button>
                        </a></li>
                </ul>
            <?php else: ?>
                <ul class="user">
                    <li><a href="index.php?page=login">
                            <button>
                                <h3>Connexion</h3>
                            </button>
                        </a></li>
                    <li><a href="index.php?page=register">
                            <button>
                                <h3>Inscription</h3>
                            </button>
                        </a></li>
                </ul>
            <?php endif; ?>
        </nav>
    </header>