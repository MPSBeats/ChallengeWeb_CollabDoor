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
                        <img src="<?php echo $learning['thumbnail']; ?>" alt="image de l'oeuvre">
                        <div class="oeuvre-info formation">
                            <div>
                                <h4><?= htmlspecialchars($learning['title']) ?></h4>
                            </div>
                            <div>
                                <p><?= htmlspecialchars($learning['price']) ?>€</p>
                            </div>
                            <div>
                                <p>
                                    <?= htmlspecialchars($learning['rate']) ?>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-star">
                                        <path d="M11.525 2.295a.53.53 0 0 1 .95 0l2.31 4.679a2.123 2.123 0 0 0 1.595 1.16l5.166.756a.53.53 0 0 1 .294.904l-3.736 3.638a2.123 2.123 0 0 0-.611 1.878l.882 5.14a.53.53 0 0 1-.771.56l-4.618-2.428a2.122 2.122 0 0 0-1.973 0L6.396 21.01a.53.53 0 0 1-.77-.56l.881-5.139a2.122 2.122 0 0 0-.611-1.879L2.16 9.795a.53.53 0 0 1 .294-.906l5.165-.755a2.122 2.122 0 0 0 1.597-1.16z" />
                                    </svg>
                                </p>
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