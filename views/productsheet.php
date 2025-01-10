<?php
/**
 * Ce fichier représente la vue de la fiche produit.
 * 
 * Il inclut les modèles nécessaires, récupère les données de collaboration et les utilisateurs associés,
 * puis les affiche dans la vue.
 * 
 * @file /c:/Users/sacha/Desktop/COLLABDOOR/ChallengeWeb_CollabDoor/views/productsheet.php
 */

// Inclusion des modèles nécessaires pour la base de données et la fiche produit
require_once '../models/database.php';
require_once '../models/productsheetModel.php';

// Connexion à la base de données
$db = (new Database())->connect();

// Création d'une instance de ProductSheet pour récupérer les données
$productsheet = new ProductSheet();

// Récupération des informations de collaboration par ID
$collaborations = $productsheet->fetchCollaborationById($_GET['id']);
$collaboration = $collaborations[0] ?? null; // Accès au premier élément du tableau

// Récupération des pseudos des utilisateurs associés à la collaboration
$Pseudos = $productsheet->fetchUsersByCollaborationId($_GET['id']);
$Pseudo = $Pseudos[0] ?? null; // Accès au premier élément du tableau

?>

<!-- Affichage de la fiche produit -->
<main id="productsheet">
    <div class="space"></div>

    <div>
        <article>
            <!-- Affichage de l'image de la collaboration -->
            <img src="<?= htmlspecialchars($collaboration['thumbnail']) ?>" alt="Image collab">
        </article>
        <article>
            <!-- Affichage du titre de la collaboration -->
            <h3><?= $collaboration['title']?></h3>
            <h4>L'Équipe</h4>
            <ul>
                <?php
                // Boucle pour afficher les pseudos des utilisateurs
                foreach ($Pseudos as $pseudo) {
                    ?><li onclick="window.location.href='index.php?page=profilView&id=<?= $pseudo['id_user']?>'"> <?=$pseudo['pseudo']?></li>
                <?php } ?>
            </ul>
            <!-- Description de la collaboration -->
            <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Aliquid tempora repudiandae beatae quos dolor eos explicabo omnis non consequatur totam? Velit sapiente laborum aliquam soluta alias similique, culpa eius aperiam?</p>
            <!-- Date de publication de la collaboration -->
            <h4>Le <?= $collaboration['published_at']?></h4>
        </article>
    </div>
</main>