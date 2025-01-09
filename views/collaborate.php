<?php

    require_once '../models/database.php';
    $db= (new Database())->connect();



?>

<main id="discover">
    <div class="space"></div>


    <aside>
        <h2>Collaborer</h2>
        <p>Fais toi kiffer en colaborant avec quelqu'un</p>
    </aside>


    <form action="">
        <label for="">
            <input type="text" name="recherche" placeholder="Rechercher un artiste, une collab...">
            <button type="submit" name="recherche"><img src="assets/img/search.svg" alt="loupe"></button>
        </label>
        <span>Filtrer par <img src="assets/img/chevron-up.svg" alt="up"></span>
        <div id="filter">
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
        <h3>Collaborer avec :</h3>
        <button id="bLeftFiche"><img src="assets/img/circle-chevron-left.svg" alt="fleche gauche"></button>
        <section id="carrousselCollab">
            <?php

            $sql = "SELECT * FROM searchcollaborations ";
            $result = $db->prepare($sql);
            $result->execute();
            $collaborations = $result->fetchAll(PDO::FETCH_ASSOC);


            if (!empty($collaborations)): ?>
                <?php foreach ($collaborations as $collab): ?>
                    <article class="oeuvre">
                        <img src="assets/media/collaboration/image/picture1.png" alt="">
                        <div>
                        <div>
                            <h4><?= htmlspecialchars($collab['title']) ?></h4>

                        </div>
                        <?php

                        $sqlPseudo = "SELECT u.pseudo
                                        FROM Users u
                                        JOIN UserCollaborations uc ON u.id_user = uc.id_user
                                        JOIN Collaborations c ON uc.id_collaboration = c.id_collaboration
                                        WHERE c.id_collaboration = " . $collab['id_collaboration'];
                        $resultPseudo = $db->prepare($sql);
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
        <button id="bRightFiche"><img src="assets/img/circle-chevron-right.svg" alt="fleche droite"></button>

    </section>


    </section>





</main>