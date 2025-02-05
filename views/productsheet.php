<?php
require_once '../models/database.php';
require_once '../models/productsheetModel.php';
require_once '../models/profileModel.php';

$db = (new Database())->connect();


$productsheet = new ProductSheet();


$collaborations = $productsheet->fetchCollaborationById($_GET['id']);
$collaboration = $collaborations[0] ?? null; // Accès au premier élément du tableau


$Pseudos = $productsheet->fetchUsersByCollaborationId($_GET['id']);
$Pseudo = $Pseudos[0] ?? null; // Accès au premier élément du tableau

?>
<main id="productsheet">
    <div class="space"></div>

    <div>
        <article>
            <img src="<?= htmlspecialchars($collaboration['thumbnail']) ?>" alt="Image collab">
        </article>
        <article>
            <h3><?= $collaboration['title']?></h3>
            <h4>L'Équipe</h4>
            <ul>
                <?php
                $profil = new Profile();
                $profilePicture = $profil->getPicture($Pseudos[0]['pseudo']);
                // Boucle pour afficher les pseudos des utilisateurs
                foreach ($Pseudos as $pseudo) {
                    ?><li onclick="window.location.href='index.php?page=profile&artist=<?=$Pseudos[0]['pseudo']?>'"> <?=$pseudo['pseudo']?></li>
                <?php } ?>
            </ul>

            <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Aliquid tempora repudiandae beatae quos dolor eos explicabo omnis non consequatur totam? Velit sapiente laborum aliquam soluta alias similique, culpa eius aperiam?</p>
            <h4>Le <?= $collaboration['published_at']?></h4>
        </article>
    </div>
</main>