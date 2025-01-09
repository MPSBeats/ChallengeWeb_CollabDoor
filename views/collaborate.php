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
            <article class="fiche_artiste">
                <img src="assets/img/fiche_artistique.png" alt="">
                <div>
                    <h4>MpsontheBeat</h4>
                    <p>Recherche violoniste qui sait faire différents styles</p>
                    <ul>
                        <li>#Violon</li>
                        <li>#prod</li>
                        <li>#hiphop</li>
                    </ul>
                </div>
            </article>
            <article class="fiche_artiste">
                <img src="assets/img/fiche_artistique.png" alt="">
                <div>
                    <h4>MpsontheBeat</h4>
                    <p>Recherche violoniste qui sait faire différents styles</p>
                    <ul>
                        <li>#Violon</li>
                        <li>#prod</li>
                        <li>#hiphop</li>
                    </ul>
                </div>
            </article>
            <article class="fiche_artiste">
                <img src="assets/img/fiche_artistique.png" alt="">
                <div>
                    <h4>MpsontheBeat</h4>
                    <p>Recherche violoniste qui sait faire différents styles</p>
                    <ul>
                        <li>#Violon</li>
                        <li>#prod</li>
                        <li>#hiphop</li>
                    </ul>
                </div>
            </article>
            <article class="fiche_artiste">
                <img src="assets/img/fiche_artistique.png" alt="">
                <div>
                    <h4>MpsontheBeat</h4>
                    <p>Recherche violoniste qui sait faire différents styles</p>
                    <ul>
                        <li>#Violon</li>
                        <li>#prod</li>
                        <li>#hiphop</li>
                    </ul>
                </div>
            </article>
            <article class="fiche_artiste">
                <img src="assets/img/fiche_artistique.png" alt="">
                <div>
                    <h4>MpsontheBeat</h4>
                    <p>Recherche violoniste qui sait faire différents styles</p>
                    <ul>
                        <li>#Violon</li>
                        <li>#prod</li>
                        <li>#hiphop</li>
                    </ul>
                </div>
            </article>
            <article class="fiche_artiste">
                <img src="assets/img/fiche_artistique.png" alt="">
                <div>
                    <h4>MpsontheBeat</h4>
                    <p>Recherche violoniste qui sait faire différents styles</p>
                    <ul>
                        <li>#Violon</li>
                        <li>#prod</li>
                        <li>#hiphop</li>
                    </ul>
                </div>
            </article>
            <article class="fiche_artiste">
                <img src="assets/img/fiche_artistique.png" alt="">
                <div>
                    <h4>MpsontheBeat</h4>
                    <p>Recherche violoniste qui sait faire différents styles</p>
                    <ul>
                        <li>#Violon</li>
                        <li>#prod</li>
                        <li>#hiphop</li>
                    </ul>
                </div>
            </article>
        </section>
        <button id="bRightFiche"><img src="assets/img/circle-chevron-right.svg" alt="fleche droite"></button>

    </section>


    </section>





</main>