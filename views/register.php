<?php

?>

<main>
    <div class="space"></div>
    <div class="form">
        <form action="">
            <div class="form-box">
                <h3>Créer un compte</h3>
                <input type="text" name="peusdo" id="peusdo" placeholder="Pseudo" required>
                <input type="password" name="password" id="password" placeholder="Mot de passe" required>
                <input type="password" name="password" id="password" placeholder="Confirmer le mot de passe" required>
                <div class="btn-box">
                    <button type="button">Suivant</button>
                </div>
            </div>

            <div class="form-box">
                <h3>Informations personnelles</h3>
                <input type="text" name="firstname" id="firstnamme" placeholder="Prénom" required>
                <input type="text" name="lastname" id="lastname" placeholder="Nom" required>
                <input type="date" name="birth" id="birth" required>
                <input type="text" name="country" id="country" placeholder="Pays" required>
                <div class="btn-box">
                    <button type="button">Retour</button>
                    <button type="button">Suivant</button>
                </div>
            </div>

            <div class="form-box">
                <h3>Informations de contact</h3>
                <input type="email" name="email" id="email" placeholder="Email" required>
                <input type="tel" name="phone" id="phone" placeholder="Téléphone" required>
            </div>

            <div class="form-box">
                <h3>Photo de profil</h3>
                <input type="file" name="picture" id="picture" accept="image/png, image/jpeg" required>

                <button type="submit">S'inscrire</button>
            </div>
        </form>

        <script>

        </script>


</main>