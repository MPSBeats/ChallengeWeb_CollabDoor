<?php
session_start();

// Determine the page title based on the current page
$page = $_GET['page'] ?? 'home'; // Default to 'home' if no page is set


$pageTitles = [
    'home' => 'Home - CollabDoor',
    'collaborate' => 'Collaborer - CollabDoor',
    'discover' => 'Découvrir - CollabDoor',
    'learn' => 'Apprendre - CollabDoor',
    'profile' => 'Profil - CollabDoor',
    'login' => 'Connexion - CollabDoor',
    'register' => 'Inscription - CollabDoor',
];


$title = $pageTitles[$page] ?? 'CollabDoor'; // Default to 'CollabDoor' if page not in the array
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/assets/css/main.css">
    <link rel="icon" href="/assets/img/IconCollabDoor.png" type="image/x-icon">
    <script src="https://unpkg.com/lenis@1.1.18/dist/lenis.min.js"></script>
    <title><?= htmlspecialchars($title) ?></title>
</head>

<body>
    <header>
        <nav>
            <a href="index.php?page=home">
                <img src="/assets/img/IconCollabdoor.svg" alt="logo">
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
                $profile = [
                    'pseudo' => $_SESSION['pseudo'],
                    'email' => $_SESSION['email'] ?? 'example@example.com',
                    'age' => $_SESSION['age'] ?? 25
                ];
                ?>
                <ul class="user">
                    <li><a href="index.php?page=profile">
                            <button>
                                <h3>Profil</h3>
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
</body>

</html>
