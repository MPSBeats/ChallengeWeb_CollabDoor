<?php
require_once "../models/database.php";

$db = (new Database())->connect();
?>

<main>
    <section class="hero">
        <div class="space"></div>
        <div class="content">
            <img src="assets/img/logoCollabdoor.svg" alt="" width="800vh">
            <h2>La collab entre artistes n'a jamais été aussi facile !</h2>
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
                <h1><a href="index.php?page=collaborate">Collaborer</a></h1>
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
            $filteredUsers = array_filter($users, function ($user) use ($currentUser) {
                return $user['pseudo'] !== $currentUser;
            });


            // Limiter le nombre d'utilisateurs affichés à 4
            $filteredUsers = array_slice($filteredUsers, 0, 4);
            ?>

            <div class="bot-card">
                <?php foreach ($filteredUsers as $user): ?>

                    <form action="index.php" method="get" class="card">
                        <input type="hidden" name="page" value="profile">
                        <input type="hidden" name="artist" value="<?= htmlspecialchars($user['pseudo']); ?>">
                        <img style="cursor: pointer;" src="<?= htmlspecialchars($user['picture']); ?>" alt="<?= htmlspecialchars($user['pseudo']); ?>" onclick="this.closest('form').submit();">
                        <p><?= htmlspecialchars($user['pseudo']); ?></p>

                    </form>
                <?php endforeach; ?>
            </div>

        </div>
    </section>

    <section class="discover">
        <div class="big-card">
            <div class="top-card">
                <h1><a href="index.php?page=discover">Découvrir</a></h1>
                <p style="font-family: Fira code;"><a href="index.php?page=discover">--></a></p>
            </div>
            <div class="bot-card">
                <?php
                $sql1 = "SELECT * FROM collaborations";
                $result1 = $db->prepare($sql1);
                $result1->execute();
                $collaborations = $result1->fetchAll(PDO::FETCH_ASSOC);

                if (!empty($collaborations)):
                    // Mélanger les collaborations pour un affichage aléatoire
                    shuffle($collaborations);

                    // Afficher seulement 4 collaborations aléatoires
                    foreach (array_slice($collaborations, 0, 4) as $collab): ?>
                        <article class="oeuvre">
                            <img src="assets/img/picture1.png" alt="">
                            <div>
                                <div>
                                    <h4><?= htmlspecialchars($collab['title']) ?></h4>
                                </div>
                                <?php
                                $sqlPseudo = "SELECT u.pseudo
                                        FROM Users u
                                        JOIN UserCollaborations uc ON u.id_user = uc.id_user
                                        JOIN Collaborations c ON uc.id_collaborations = c.id_collaborations
                                        WHERE c.id_collaborations = " . $collab['id_collaborations'];
                                $resultPseudo = $db->prepare($sqlPseudo);
                                $resultPseudo->execute();
                                $Pseudos = $resultPseudo->fetchAll(PDO::FETCH_ASSOC);
                                ?>
                                <p><?php foreach ($Pseudos as $pseudo): echo htmlspecialchars($pseudo['pseudo']) . ' ';
                                    endforeach; ?></p>
                            </div>
                        </article>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>Aucune collaboration trouvée.</p>
                <?php endif; ?>
            </div>
    </section>





    <section class="learn">
        <div class="big-card">
            <div class="top-card">
                <h1><a href="index.php?page=learn">Apprendre</a></h1>
                <p style="font-family: Fira code;"><a href="index.php?page=learn">--></a></p>
            </div>
            <div class="work-in-progress">
                🚧 Work in progress 🚧
            </div>
        </div>
    </section>
</main>