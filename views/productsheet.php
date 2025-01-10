<?php

require_once '../models/database.php';
require_once '../models/productsheetModel.php';
$db = (new Database())->connect();
$productsheet = new ProductSheet();

$collaborations = $productsheet->fetchCollaborationById($_GET['id']);
$collaboration = $collaborations[0] ?? null; // Accédez au premier élément du tableau


 // Requête pour récupérer les pseudos des utilisateurs associés à la collaboration

$Pseudos = $productsheet->fetchUsersByCollaborationId($_GET['id']);
$Pseudo = $Pseudos[0] ?? null; // Accédez au premier élément du tableau

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
                foreach ($Pseudos as $pseudo) {
                    ?><li onclick="window.location.href='index.php?page=profilView&id=<?= $pseudo['id_user']?>'"> <?=$pseudo['pseudo']?></li>

               <?php } ?>


            </ul>
            <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Aliquid tempora repudiandae beatae quos dolor eos explicabo omnis non consequatur totam? Velit sapiente laborum aliquam soluta alias similique, culpa eius aperiam?</p>
            <h4>Le <?= $collaboration['published_at']?></h4>


        </article>
    </div>





</main>