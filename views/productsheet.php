<?php

require_once '../models/database.php';
$db = (new Database())->connect();


$sqlcollab = "SELECT * FROM collaborations WHERE id_collaborations = " . $_GET['id'];
$resultCollab = $db->prepare($sqlcollab);
$resultCollab->execute();
$collaborations = $resultCollab->fetchAll(PDO::FETCH_ASSOC);
$collaboration = $collaborations[0] ?? null; // Accédez au premier élément du tableau


 // Requête pour récupérer les pseudos des utilisateurs associés à la collaboration
 $sqlPseudo = "SELECT u.pseudo, u.id_user
 FROM Users u
 JOIN UserCollaborations uc ON u.id_user = uc.id_user
 JOIN Collaborations c ON uc.id_collaborations = c.id_collaborations
 WHERE c.id_collaborations = " . $_GET['id'];
$resultPseudo = $db->prepare($sqlPseudo);
$resultPseudo->execute();
$Pseudos = $resultPseudo->fetchAll(PDO::FETCH_ASSOC);
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
                    ?><li onclick="window.location.href='index.php?page=profilView&id=<?= $pseudo['id_user']?>"> <?=$pseudo['pseudo']?></li>

               <?php } ?>


            </ul>
            <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Aliquid tempora repudiandae beatae quos dolor eos explicabo omnis non consequatur totam? Velit sapiente laborum aliquam soluta alias similique, culpa eius aperiam?</p>
            <h4>Le <?= $collaboration['published_at']?></h4>


        </article>
    </div>





</main>