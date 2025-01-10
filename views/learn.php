<?php
// Inclusion du modèle learnsModel.php
require_once '../models/learnsModel.php';

// Création d'une instance de la classe Learn et récupération de toutes les formations
$learning = new Learn();
$learnings = $learning->getAllLearnings();

?>

<main id="discover">
    <div class="space"></div>

    <aside>
        <h2>Apprendre</h2>
        <p>Réveiller l'artiste qui someille en vous !</p>
    </aside>

    <!-- Formulaire de recherche et de filtrage -->
    <form action="search.php" method="get">
        <label for="recherche">
            <input type="text" name="recherche" placeholder="Rechercher une formation">
            <button type="submit" name="recherche"><img src="assets/img/search.svg" alt="loupe"></button>
        </label>
        <span>Filtrer par <img src="assets/img/chevron-up.svg" alt="up"></span>
        <div id="filter">
            <div>
                <input type="radio" name="type" id="instrument" value="1">
                <label for="instrument">Instrument</label>
            </div>
            <div>
                <input type="radio" name="type" id="duree" value="2">
                <label for="duree">Durée</label>
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
        <h3>Les formations</h3>
        <button id="button_left"><img src="assets/img/circle-chevron-left.svg" alt="fleche gauche"></button>
        <section id="carrousselpepite">
            <?php
            // Vérification si des formations sont disponibles
            if (!empty($learnings)): ?>
                <?php foreach ($learnings as $learning): ?>
                    <!-- Affichage des formations -->
                    <article class="oeuvre" onclick="window.location.href='index.php?page=learningProfile&learning=<?= $learning['title'] ?>'">
                        <img src="assets/img/picture1.png" alt="">
                        <div>
                            <div>
                                <h4><?= htmlspecialchars($learning['title']) ?></h4>
                            </div>
                        </div>
                    </article>
                <?php endforeach; ?>
            <?php else: ?>
                <p>Aucune formations trouvée.</p>
            <?php endif; ?>
        </section>
        <button id="button_right"><img src="assets/img/circle-chevron-right.svg" alt="fleche droite"></button>
    </section>
</main>
