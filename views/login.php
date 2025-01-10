<?php

require_once '../models/userModel.php'; // Inclusion du modèle utilisateur

$user = new User();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupération des données du formulaire
    $pseudo = htmlspecialchars($_POST['pseudo']);
    $password = htmlspecialchars($_POST['password']);

    // Vérification des champs vides
    if (empty($password) || empty($pseudo)) {
        $error = 'Veuillez remplir tous les champs';
    } else {
        // Tentative de connexion de l'utilisateur
        $loggedInUser = $user->login($pseudo, $password);

        if ($loggedInUser) {
            // Connexion réussie, redirection vers la page de profil
            $_SESSION['pseudo'] = $loggedInUser['pseudo'];

            header("Location: index.php?page=profile");
            exit();
        } else {
            // Connexion échouée, message d'erreur
            $error = "Pseudo ou mot de passe incorrect";
        }
    }
}
?>

<main class="login">
    <div class="space"></div>
    <h1>Connexion :</h1>
    <?php if (isset($error)): ?>
        <p class="error"><?php echo htmlspecialchars($error); ?></p> <!-- Affichage du message d'erreur -->
    <?php endif; ?>
    <div class="container">
        <form action="index.php?page=login" method="post">
            <input type="text" name="pseudo" placeholder="Pseudo" required> <!-- Champ pseudo -->
            <input type="password" name="password" placeholder="Password" required> <!-- Champ mot de passe -->
            <button type="submit">Login</button> <!-- Bouton de soumission -->
        </form>
    </div>
</main>