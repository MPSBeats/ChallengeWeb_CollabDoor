<?php

    require_once '../models/database.php';
    $db= (new Database())->connect();



?>



<main id="discover">
    <div class="space"></div>
    
    <aside>
        <h2>Découvrir</h2>
        <p>Vois ce qui te plait chef</p>
    </aside>

    <form action="">
        <label for="recherche">
        <input type="text" name="recherche" placeholder="Rechercher un artiste, une collab...">
        <button type="submit" name="recherche"><img src="assets/img/search.svg" alt="loupe"></button>
        </label>
        <span>Filtrer par <img src="assets/img/chevron-up.svg" alt="up"></span>
        <div>
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
            <label for="recherchetag" id ="tag">
            <input type="text" name="recherchetag" placeholder="Rechercher un #tag...">
            <button name="recherchetag"><img src="assets/img/search.svg" alt="loupe"></button></label>
        </div>
    </form>

    <section>
        <h3>Pépite de la semaine :</h3>
        <button id="button_left"><img src="assets/img/circle-chevron-left.svg" alt="fleche gauche"></button>
        <section id="carrousselpepite">

            <?php
            
            $sql="SELECT * FROM collaborations ";
            $result= $db->prepare($sql);
            $result->execute();
            $collaborations = $result->fetchAll(PDO::FETCH_ASSOC);


            if (!empty($collaborations)): ?>
                <?php foreach ($collaborations as $collab): ?>
                    <article class="oeuvre">
                        <img src="assets/img/picture1.png" alt="">
                        <div>
                            <div>
                                <h4><?= htmlspecialchars($collab['title']) ?></h4>
                                
                            </div>
                            <?php
                            $sqlPseudo = "
                            SELECT  
                                STRING_AGG(u.pseudo, ', ' ORDER BY u.pseudo) AS users
                            FROM collaborations c
                            JOIN usercollaborations uc ON c.id_collaborations = uc.id_collaborations
                            JOIN users u ON uc.id_user = u.id_user
                            WHERE c.id_collaborations = :id_collaborations
                            GROUP BY c.id_collaborations
                        ";
                        
                        $resultPseudo = $db->prepare($sqlPseudo);
                        $resultPseudo->bindParam(':id_collaborations', $collab['id_collaborations'], PDO::PARAM_INT);
                        $resultPseudo->execute();
                        $Pseudos = $resultPseudo->fetchAll(PDO::FETCH_ASSOC);
                        
                        if (!empty($Pseudos)) {
                        
                            foreach ($Pseudos as $pseudo) {
                                if (isset($pseudo['users'])) { 
                                    echo htmlspecialchars($pseudo['users']) . "<br>"; 
                                } else {
                                    echo "Aucun utilisateur trouvé.<br>";
                                }
                            }
                        } else {
                            echo "Aucune collaboration trouvée.<br>";
                        }
                                   ?>
                        </div>
                    </article>
                <?php endforeach; ?>
            <?php else: ?>
                <p>Aucune collaboration trouvée.</p>
            <?php endif; ?>


            $sqlPseudo = "
    SELECT  
        c.id_collaboration,
        STRING_AGG(u.pseudo, ', ' ORDER BY u.pseudo) AS users
    FROM collaboration c
    JOIN userscollaborations uc ON c.id_collaboration = uc.id_collaboration
    JOIN users u ON uc.id_user = u.id_user
    GROUP BY c.id_collaboration
";

$resultPseudo = $db->prepare($sqlPseudo);
$resultPseudo->execute();
$Pseudos = $resultPseudo->fetchAll(PDO::FETCH_ASSOC);

if (!empty($Pseudos)) {

    foreach ($Pseudos as $pseudo) {
        if (isset($pseudo['users'])) { 
            echo htmlspecialchars($pseudo['users']) . "<br>"; 
        } else {
            echo "Aucun utilisateur trouvé.<br>";
        }
    }
} else {
    echo "Aucune collaboration trouvée.<br>";
}
           ?>
           
            

        </section>
        <button id="button_right"><img src="assets/img/circle-chevron-right.svg" alt="fleche droite"></button>
        
    </section>

    <section>
        <h3>Zoom sur un artiste</h3>
        <div id="zoomartiste">
            <span>
                <p></p>
                <h4 style="font-size: 25px;">Découvrez un gars random et sa collection</h4> <span><button id="bLeftArtiste"><img src="assets/img/move-left.svg" alt="fleche gauche"></button> <button id="bRightArtiste"><img src="assets/img/move-right.svg" alt="fleche droite"></button></span>
            </span>
            <img src="assets/img/profile-picture.jpg" alt="hero">
            <section id="carrousselartiste">
            <article class="oeuvre">
            </article>
            <article class="oeuvre">
                <img src="assets/img/picture1.png" alt="">
                <div>
                    <h4>POUMTCHAK</h4>
                    <p>MPS, elsyr, zoji, her...</p>
                </div>
            </article>
            <article class="oeuvre">
                <img src="assets/img/picture1.png" alt="">
                <div>
                    <h4>POUMTCHAK</h4>
                    <p>MPS, elsyr, zoji, her...</p>
                </div>
            </article>
            <article class="oeuvre">
                <img src="assets/img/picture1.png" alt="">
                <div>
                    <h4>POUMTCHAK</h4>
                    <p>MPS, elsyr, zoji, her...</p>
                </div>
            </article>
            <article class="oeuvre">
                <img src="assets/img/picture1.png" alt="">
                <div>
                    <h4>POUMTCHAK</h4>
                    <p>MPS, elsyr, zoji, her...</p>
                </div>
            </article>
            <article class="oeuvre">
                <img src="assets/img/picture1.png" alt="">
                <div>
                    <h4>POUMTCHAK</h4>
                    <p>MPS, elsyr, zoji, her...</p>
                </div>
            </article>
            <article class="oeuvre">
                <img src="assets/img/picture1.png" alt="">
                <div>
                    <h4>POUMTCHAK</h4>
                    <p>MPS, elsyr, zoji, her...</p>
                </div>
            </article>
            
        </section>
        </div>
        
    </section>








</main>