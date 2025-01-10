<?php
require_once "../models/database.php";
require_once "../models/learnsModel.php";
require_once "../models/collaborateModel.php";
require_once "../models/userModel.php";

// Connexion à la base de données
$db = (new Database())->connect();
$learns = new Learn();
$collaborations = new Collaborate();
$users = new User();
?>

<main>
    <section class="hero">
        <div class="space"></div>
        <div class="content">
            <img src="assets/img/logoCollabdoor.png" alt="">
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
            $usersAll = $users->getPseudoPicture();

            // Mélanger les utilisateurs pour un affichage aléatoire
            shuffle($usersAll);
            
            // Récupérer le pseudo de l'utilisateur connecté
            $currentUser = $_SESSION['pseudo'] ?? '';
            // Filtrer les utilisateurs pour exclure l'utilisateur connecté
            $filteredUsers = array_filter($usersAll, function ($user) use ($currentUser) {
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
                        <!-- Afficher l'image de l'utilisateur, clique pour soumettre le formulaire -->
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
                // Récupérer toutes les collaborations
                $collaborationsAll = $collaborations->getAllCollaborations();

                if (!empty($collaborationsAll)):
                    // Mélanger les collaborations pour un affichage aléatoire
                    shuffle($collaborationsAll);

                    // Afficher seulement 4 collaborations aléatoires
                    foreach (array_slice($collaborationsAll, 0, 4) as $collab): ?>
                        <article class="oeuvre">
                            <img src="assets/img/picture1.png" alt="">
                            <div>
                                <div>
                                    <h4><?= htmlspecialchars($collab['title']) ?></h4>
                                </div>
                                <?php
                                // Récupérer les pseudos des utilisateurs associés à chaque collaboration

                                $Pseudos = $collaborations->getPseudoCollaboration($collab['id_collaborations']);
                                ?>
                                <p><?php foreach ($Pseudos as $pseudo): echo htmlspecialchars($pseudo['pseudo']) . ' '; endforeach; ?></p>
                            </div>
                        </article>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>Aucune collaboration trouvée.</p>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <section class="learn">
        <div class="big-card">
            <div class="top-card">
                <h1><a href="index.php?page=learn">Apprendre</a></h1>
                <p style="font-family: Fira code;"><a href="index.php?page=learn">--></a></p>
            </div>
            <div class="bot-card">
            <?php
                // Récupérer toutes les formations
                $learnings = $learns->getAllLearnings();

                if (!empty($learnings)):
                    // Mélanger les formations pour un affichage aléatoire
                    shuffle($learnings);

                    // Afficher seulement 4 formations aléatoires
                    foreach (array_slice($learnings, 0, 4) as $learning): ?>
                        <article class="oeuvre">
                            <img src="<?php echo $learning['thumbnail']?>" alt="">
                            <div>
                                <div>
                                    <h4><?= htmlspecialchars($learning['title']) ?></h4>
                                </div>
                                <?php
                                // Récupérer les pseudos des utilisateurs associés à chaque formation
                                $Pseudos = $learns->getPseudoByLearning($learning['id_learning']);
                                ?>
                                <p><?php foreach ($Pseudos as $pseudo): echo htmlspecialchars($pseudo['pseudo']) . ' '; endforeach; ?></p>
                            </div>
                        </article>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>Aucune formation trouvée.</p>
                <?php endif; ?>

            </div>

        </div>
    </section>
</main>
