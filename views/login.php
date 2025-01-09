<?php
    session_start();
    require_once '../models/userModel.php';

    $user = new User();

    var_dump($_SESSION);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Récupération des données du formulaire
        $pseudo = htmlspecialchars($_POST['pseudo']);
        $password = htmlspecialchars($_POST['password']);

        // Vérifaction des champs vides
        if (empty($password) || empty($pseudo)) {
            $error = 'Veuillez remplir tous les champs';
        }
        else {
            $loggedInUser = $user->login($pseudo, $password);

            if($loggedInUser){
                $_SESSION['pseudo'] = $loggedInUser['pseudo'];

                header("Location: index.php");
                exit();
            } else {
                $error = "Pseudo ou mot de passe incorrect";
            }   
        }
    }
?>

<main class="login">
    <div class="space"></div>
    <?php if (isset($error)): ?>
            <p class="error"><?php echo htmlspecialchars($error); ?></p>
        <?php endif; ?>
    <div class="container">
        <form action="index.php?page=login" method="post">
            <input type="text" name="pseudo" placeholder="Pseudo" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Login</button>
        </form>
    </div>
</main>