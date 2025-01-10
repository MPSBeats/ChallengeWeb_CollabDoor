<?php
require_once '../models/database.php';
require_once '../models/searchsheetModel.php';

$db = (new Database())->connect();


$searchsheet = new SearchSheet();

$searchsheets = $searchsheet->fetchSearchById($_GET['id']);
$search = $searchsheets[0] ?? null; // Accès au premier élément du tableau

$Pseudos = $searchsheet->fetchUsersBySearchCollaborationsId($_GET['id']);
        $Pseudo = $Pseudos[0] ?? null; // Accès au premier élément du tableau


?>
<main id="productsheet">
    <div class="space"></div>

    <div>
        <article>
            <img src="<?= htmlspecialchars($search['thumbnail']) ?>" alt="Image collab">
        </article>
        <article>
            <h3><?= $search['title']?></h3>
            <h4>L'Équipe</h4>
            <ul>
                <?php
        
                // Boucle pour afficher les pseudos des utilisateurs
                foreach ($Pseudos as $pseudo) {
                    ?><li onclick="window.location.href='index.php?page=profile&artist=<?=$Pseudos[0]['pseudo']?>'"> <?=$pseudo['pseudo']?></li>
                <?php } ?>
            </ul>
            <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Aliquid tempora repudiandae beatae quos dolor eos explicabo omnis non consequatur totam? Velit sapiente laborum aliquam soluta alias similique, culpa eius aperiam?</p>
            <h4>Le <?= $search['published_at']?></h4>
        </article>
    </div>
</main>