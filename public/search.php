<?php

require_once '../models/database.php';
$db = (new Database())->connect();

// Initialisez la variable $oeuvres
$oeuvres = null;

if (isset($_GET['recherche']) && !empty($_GET['recherche'])) {
    $recherche = htmlspecialchars($_GET['recherche']);
    $sql = "SELECT title FROM collaborations WHERE title LIKE :recherche ORDER BY title";
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':recherche', '%' . $recherche . '%', PDO::PARAM_STR);
    $stmt->execute();
    $oeuvres = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>

<main id="search-results">
    <h2>Résultats de la recherche</h2>

    <ul>
        <?php if ($oeuvres): ?>
            <?php foreach ($oeuvres as $o): ?>
                <li><?= htmlspecialchars($o['title']) ?></li>
            <?php endforeach; ?>
        <?php else: ?>
            <li>Aucune œuvre trouvée.</li>
        <?php endif; ?>
    </ul>

    <a href="discover.php">Retour à la page Découvrir</a>
</main>