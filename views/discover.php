<?php

// Inclusion du fichier de connexion à la base de données
require_once '../models/database.php';
$db = (new Database())->connect();

// Inclusion du modèle Discover
require_once '../models/discoverModel.php';
$discover = new Discover();
?>

<main id="discover">
    <div class="space"></div>

    <aside>
        <h2>Découvrir</h2>
        <p>Viens découvrir les futures stars de demain !</p>
    </aside>

    <!-- Formulaire de recherche -->
    <form action="search.php" method="get">
        <label for="recherche">
            <input type="text" name="recherche" placeholder="Rechercher un artiste, une collab...">
            <button type="submit" name="recherche"><img src="assets/img/search.svg" alt="loupe"></button>
        </label>
        <span>Filtrer par <img src="assets/img/chevron-up.svg" alt="up"></span>
        <div id="filter">
            <div>
                <input type="radio" name="type" id="collab" value="1">
                <label for="collab">Collaboration</label>
            </div>
            <div>
                <input type="radio" name="type" id="artiste" value="2">
                <label for="artiste">Artiste</label>
            </div>
            <hr>
            <div>
                <input type="radio" name="choix" id="recent" value="3">
                <label for="recent">Plus récent</label>
            </div>
            <div>
                <input type="radio" name="choix" id="populaire" value="4">
                <label for="populaire">Plus Populaire</label>
            </div>
            <label for="recherchetag" id="tag">
                <input type="text" name="recherchetag" placeholder="Rechercher un #tag...">
                <button name="recherchetag"><img src="assets/img/search.svg" alt="loupe"></button></label>
        </div>
    </form>

    <section>
        <h3>Pépite de la semaine :</h3>
        <button id="button_left"><img src="assets/img/circle-chevron-left.svg" alt="fleche gauche"></button>
        <section id="carrousselpepite">
            <?php
            // Récupération de toutes les collaborations
            $collaborations = $discover->getAllCollaborations();

            // Récupération de toutes les collaborations des utilisateurs
            $userscollaborations = $discover->getAllUserCollaborations();

            if (!empty($collaborations)): ?>
                <?php foreach ($collaborations as $collab): ?>
                    <article class="oeuvre" onclick="window.location.href='index.php?page=productsheet&id=<?= $collab['id_collaborations'] ?>'">
                        <img src="assets/img/picture1.png" alt="">
                        <div>
                            <div>
                                <h4><?= htmlspecialchars($collab['title']) ?></h4>
                            </div>
                            <?php

                            
                            $Pseudos = $discover->getUserPseudosByCollaborationId($collab['id_collaborations']);

                            ?>
                            <div id="pseudoOeuvre">
                            <?php foreach ($Pseudos as $pseudo):?> 
                                <p><?=$pseudo['pseudo'];?></p>
                                <?php endforeach; ?></div>
                        </div>
                    </article>
                <?php endforeach; ?>
            <?php else: ?>
                <p>Aucune collaboration trouvée.</p>
            <?php endif; ?>
        </section>
        <button id="button_right"><img src="assets/img/circle-chevron-right.svg" alt="fleche droite"></button>
    </section>

    <?php  // Récupération d'un utilisateur aléatoire
    
    $randomUser = $discover->getRandomUser();


    
    $userCollaborations = $discover->getCollaborationsByRandomUserId($randomUser['id_user']);

    ?>

    <section>
        <h3>Zoom sur un artiste</h3>
        <div id="zoomartiste">
            <span>
                <p></p> <!-- exprès pour faire l'espace a gauche -->
                <h4 style="font-size: 25px;">Découvrez <?= htmlspecialchars($randomUser['pseudo']) ?> et sa collection</h4> <span><button id="bLeftArtiste"><img src="assets/img/move-left.svg" alt="fleche gauche"></button> <button id="bRightArtiste"><img src="assets/img/move-right.svg" alt="fleche droite"></button></span>
            </span>
            <img src="<?= htmlspecialchars($randomUser['picture']) ?>" alt="hero">
            <section id="carrousselartiste">
                <article class="oeuvre"></article>
                <?php if (!empty($userCollaborations)): ?>
                    <?php foreach ($userCollaborations as $collab): ?>
                        <article class="oeuvre" onclick="window.location.href='index.php?page=productsheet&id=<?= $collab['id_collaborations'] ?>'">
                            <img src="<?= htmlspecialchars($collab['thumbnail']) ?>" alt="">
                            <div>
                                <h4><?= htmlspecialchars($collab['title']) ?></h4>
                                <p>Publié le : <?= htmlspecialchars($collab['published_at']) ?></p>
                            </div>
                        </article>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>Aucune collaboration trouvée pour cet artiste.</p>
                <?php endif; ?>
            </section>
        </div>
    </section>
</main>
