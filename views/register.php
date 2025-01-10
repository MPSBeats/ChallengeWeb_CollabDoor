<?php
require_once '../models/userModel.php';
$user = new User();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupération et sécurisation des données du formulaire
    $pseudo = htmlspecialchars($_POST['pseudo']);
    $password = htmlspecialchars($_POST['password']);
    $firstname = htmlspecialchars($_POST['firstname']);
    $lastname = htmlspecialchars($_POST['lastname']);
    $birth = htmlspecialchars($_POST['birth']);
    $country = htmlspecialchars($_POST['country']);
    $email = htmlspecialchars($_POST['email']);
    $phone = htmlspecialchars($_POST['phone']);
    $picture = htmlspecialchars($_POST['picture']);



    // Vérification des champs vides
    if (empty($pseudo) || empty($password) || empty($firstname) || empty($lastname) || empty($birth) || empty($country) || empty($email) || empty($phone) || empty($picture)) {
        $error = 'Veuillez remplir tous les champs';
    } else {
        // Tentative d'inscription de l'utilisateur
        if ($user->register($pseudo, $password, $firstname, $lastname, $birth, $country, $email, $phone, $picture)) {
            $success = 'Inscription réussie ! Vous pouvez vous connecter.';
            header('Location: index.php?page=login');
        } else {
            $error = 'Une erreur est survenue lors de l\'inscription';
        }
    }
}
?>

<main class="register">
    <div class="space"></div>
    <div class="form">
        <?php if (isset($success)): ?>
            <div class="alert alert-success" role="alert">
                <?php echo $success; ?>
            </div>
        <?php endif; ?>
        <?php if (isset($error)): ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $error; ?>
            </div>
        <?php endif; ?>
        <form action="index.php?page=register" method="post">
            <!-- Formulaire étape 1 : Création de compte -->
            <div class="form-box" id="form1">
                <h3>Créer un compte</h3>
                <input type="text" name="pseudo" id="pseudo" placeholder="Pseudo" required>
                <input type="password" name="password" id="password1" placeholder="Mot de passe" required>
                <input type="password" name="password2" id="password2" placeholder="Confirmer le mot de passe" required>
                <div class="btn-box">
                    <button type="button" id="suivant1">Suivant</button>
                </div>
            </div>

            <!-- Formulaire étape 2 : Informations personnelles -->
            <div class="form-box" id="form2">
                <h3>Informations personnelles</h3>
                <input type="text" name="firstname" id="firstnamme" placeholder="Prénom" required>
                <input type="text" name="lastname" id="lastname" placeholder="Nom" required>
                <input type="date" name="birth" id="birth" required>
                <input type="text" name="country" id="country" placeholder="Pays" required>
                <div class="btn-box">
                    <button type="button" id="retour1">Retour</button>
                    <button type="button" id="suivant2">Suivant</button>
                </div>
            </div>

            <!-- Formulaire étape 3 : Informations de contact -->
            <div class="form-box" id="form3">
                <h3>Informations de contact</h3>
                <input type="email" name="email" id="email" placeholder="Email" required>
                <input type="tel" name="phone" id="phone" placeholder="Téléphone" required>
                <div class="btn-box">
                    <button type="button" id="retour2">Retour</button>
                    <button type="button" id="suivant3">Suivant</button>
                </div>
            </div>

            <!-- Formulaire étape 4 : Photo de profil -->
            <div class="form-box" id="form4">
                <h3>Photo de profil</h3>
                <input type="file" name="picture" id="picture" accept="image/png, image/jpeg" required>
                <div class="btn-box">
                    <button type="button" id="retour3">Retour</button>
                    <button id='submit' type="submit">S'inscrire</button>
                </div>
            </div>

            <!-- Barre de progression -->
            <div class="step-row">
                <div id="progress"></div>
                <div class="step-col"><small>Etape 1</small></div>
                <div class="step-col"><small>Etape 2</small></div>
                <div class="step-col"><small>Etape 3</small></div>
                <div class="step-col"><small>Etape 4</small></div>
            </div>
        </form>

        <script>
            // Gestion des étapes du formulaire
            var form1 = document.getElementById("form1");
            var form2 = document.getElementById("form2");
            var form3 = document.getElementById("form3");
            var form4 = document.getElementById("form4");

            var suivant1 = document.getElementById("suivant1");
            var suivant2 = document.getElementById("suivant2");
            var suivant3 = document.getElementById("suivant3");
            var retour1 = document.getElementById("retour1");
            var retour2 = document.getElementById("retour2");
            var retour3 = document.getElementById("retour3");
            var submit = document.getElementById("submit");

            // Gestion de la navigation avec la touche "Enter"
            document.addEventListener('keydown', function(event) {
                if (event.key === 'Enter') {
                    event.preventDefault();
                    if (progress.style.width < '179px') {
                        suivant1.click();
                    } else if (progress.style.width === "180px") {
                        suivant2.click();
                    } else if (progress.style.width === "270px") {
                        suivant3.click();
                    } else if (progress.style.width === "360px") {
                        submit.click();
                    }
                }
            });

            // Navigation entre les étapes du formulaire
            suivant1.onclick = function() {
                form1.style.left = "-450px";
                form2.style.left = "40px";
                progress.style.width = "180px";
            }

            suivant2.onclick = function() {
                form2.style.left = "-450px";
                form3.style.left = "40px";
                progress.style.width = "270px";
            }

            suivant3.onclick = function() {
                form3.style.left = "-450px";
                form4.style.left = "40px";
                progress.style.width = "360px";
            }

            retour1.onclick = function() {
                form1.style.left = "40px";
                form2.style.left = "450px";
                progress.style.width = "90px";
            }

            retour2.onclick = function() {
                form2.style.left = "40px";
                form3.style.left = "450px";
                progress.style.width = "180px";
            }

            retour3.onclick = function() {
                form3.style.left = "40px";
                form4.style.left = "450px";
                progress.style.width = "270px";
            }
        </script>
</main>