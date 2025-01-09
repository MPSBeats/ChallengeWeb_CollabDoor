<?php
require_once "../models/database.php";

$db = (new Database())->connect();
?>

<main>
    <section class="hero">
        <div class="space"></div>
        <div class="content">
            <img src="assets/img/logoCollabdoor.png" alt="">
            <h2>Your Gateway to Seamless Collaboration</h2>
        </div>
        <div class="arrow-help">
            <a href="#collaborate" id="arrow" class="smooth-scroll">
                <svg xmlns="http://www.w3.org/2000/svg" fill="#000" width="23.601" height="35.499" viewBox="0 0 23.601 35.499">
                    <path d="M12200.447,2780.352l-11.3-11.3a.5.5,0,0,1,.708-.708l10.421,10.421V2745.5a.5.5,0,1,1,1,0v33.316l10.471-10.47a.5.5,0,0,1,.708.708l-11.3,11.3a.5.5,0,0,1-.705,0Z" transform="translate(-12188.999 -2745.001)"></path>
                </svg>
            </a>
        </div>
    </section>

    <section style="height: 13vh; width:calc(100vw -32px);" id="collaborate"></section>

    <section class="collaborate">
        <div class="big-card">
            <div class="top-card">
                <h3><a href="index.php?page=collaborate">Collaborer</a></h3>
                <p style="font-family: Fira code;"><a href="index.php?page=collaborate">--></a></p>
            </div>

            <?php
            // Récupérer les données des utilisateurs
            $stmt = $db->prepare("SELECT pseudo, picture FROM Users");
            $stmt->execute();
            $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // Mélanger les utilisateurs pour un affichage aléatoire
            shuffle($users);
            // Récupérer le pseudo de l'utilisateur connecté
            $currentUser = $_SESSION['pseudo'] ?? '';

            // Filtrer les utilisateurs pour exclure l'utilisateur connecté
            $filteredUsers = array_filter($users, function($user) use ($currentUser) {
                return $user['pseudo'] !== $currentUser;
            });


            // Limiter le nombre d'utilisateurs affichés à 4
            $filteredUsers = array_slice($filteredUsers, 0, 4);
            ?>

            <div class="bot-card">
                <?php foreach ($filteredUsers as $user): ?>
                    <form action="index.php" method="get" class="card">
                        <!-- Ajouter les paramètres 'page' et 'artist' à l'URL -->
                        <input type="hidden" name="page" value="profile">
                        <input type="hidden" name="artist" value="<?= htmlspecialchars($user['pseudo']); ?>">
                        <img src="<?= htmlspecialchars($user['picture']); ?>" alt="<?= htmlspecialchars($user['pseudo']); ?>">
                        <p><?= htmlspecialchars($user['pseudo']); ?></p>
                        <button type="submit" class="submit-button">Aller au Profil</button>
                    </form>
                <?php endforeach; ?>
            </div>

        </div>
    </section>

    <section class="discover">
        <div class="big-card">
            <div class="top-card">
                <h1>Découvrir</h1>
                <p style="font-family: Fira code;"><a href="index.php?page=discover">--></a></p>
            </div>
            <div class="bot-card">
                <div class="card">
                    <img src="assets/img/picture1.png" alt="">
                    <div style="width: 100%; display: flex; align-items:center; flex-direction: column;">
                        <div style="display: flex; justify-content: space-around; width: 100%;">
                            <p>POUMTCHAK</p>
                            <p>5*</p>
                        </div>
                        <p>MPS</p>
                    </div>
                </div>
                <div class="card">
                    <img src="assets/img/picture2.png" alt="">
                    <div style="width: 100%; display: flex; align-items:center; flex-direction: column;">
                        <div style="display: flex; justify-content: space-around; width: 100%;">
                            <p>Be Human</p>
                            <p>5*</p>
                        </div>
                        <p>MPS</p>
                    </div>
                </div>
                <div class="card">
                    <img src="assets/img/picture3.png" alt="">
                    <div style="width: 100%; display: flex; align-items:center; flex-direction: column;">
                        <div style="display: flex; justify-content: space-around; width: 100%;">
                            <p>BEFORE</p>
                            <p>5*</p>
                        </div>
                        <p>MPS</p>
                    </div>
                </div>
                <div class="card">
                    <img src="assets/img/picture4.png" alt="">
                    <div style="width: 100%; display: flex; align-items:center; flex-direction: column;">
                        <div style="display: flex; justify-content: space-around; width: 100%;">
                            <p>NEW</p>
                            <p>5*</p>
                        </div>
                        <p>MPS</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="learn">
        <div class="big-card">
            <div class="top-card">
                <h1>Apprendre</h1>
                <p style="font-family: Fira code;"><a href="index.php?page=learn">--></a></p>
            </div>
            <div class="work-in-progress">
                🚧 Work in progress 🚧
            </div>
        </div>
    </section>
</main>
