<?php

require_once '../models/database.php';
$db = (new Database())->connect();



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
            $sql1 = "SELECT * FROM collaboration ";
            $result1 = $db->prepare($sql1);
            $result1->execute();
            $collaborations = $result1->fetchAll(PDO::FETCH_ASSOC);
            $sql2 = "SELECT * FROM userscollaborations ";
            $result2 = $db->prepare($sql2);
            $result2->execute();
            $userscollaborations = $result2->fetchAll(PDO::FETCH_ASSOC);






            if (!empty($collaborations)): ?>
                <?php foreach ($collaborations as $collab): ?>
                    <article class="oeuvre">
                        <img src="assets/img/picture1.png" alt="">
                        <div>
                            <div>
                                <h4><?= htmlspecialchars($collab['title']) ?></h4>

                            </div>
                            <?php

                            $sqlPseudo = "SELECT u.pseudo
                                            FROM Users u
                                            JOIN UsersCollaborations uc ON u.id_user = uc.id_user
                                            JOIN Collaboration c ON uc.id_collaboration = c.id_collaboration
                                            WHERE c.id_collaboration = " . $collab['id_collaboration'];
                            $resultPseudo = $db->prepare($sqlPseudo);
                            $resultPseudo->execute();
                            $Pseudos = $resultPseudo->fetchAll(PDO::FETCH_ASSOC);
                            var_dump($sqlPseudo);
                            var_dump($resultPseudo);
                            var_dump($Pseudos);
                            ?>
                            <p><?php foreach ($Pseudos as $pseudo): echo $pseudo['pseudo'];
                                endforeach; ?></p>
                        </div>
                    </article>
                <?php endforeach; ?>
            <?php else: ?>
                <p>Aucune collaboration trouvée.</p>
            <?php endif; ?>






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