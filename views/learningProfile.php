<?php

/**
 * Ce fichier gère l'affichage et l'inscription à une formation spécifique.
 * 
 * @file learningProfile.php
 */

require_once '../models/learnsModel.php';
require_once '../models/userModel.php';

$learning = new Learn();
$user = new User();

// Vérifie si une formation spécifique est sélectionnée
if (isset($_GET['learning'])) {
    $selectedFormation = $learning->getLearningById($_GET['learning']);
    $currentLearning = $title = htmlspecialchars($selectedFormation['title']);
} else {
    // Redirige vers la page des formations si aucune formation n'est sélectionnée
    header('Location: index.php?page=formations');
    exit();
}

// Vérifie si l'utilisateur s'inscrit à une formation
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['formation_id'])) {
    if (isset($_SESSION['pseudo'])) {
        $userId = $user->getUserId($_SESSION['pseudo']); // Récupère l'ID de l'utilisateur à partir de la session
        $formationId = $_POST['formation_id'];
        $isEnrolled = $learning->insertUserLearning($userId, $formationId);

        if ($isEnrolled) {
            // Redirige vers la même page avec un message de succès
            header("Location: index.php?page=learningProfile&learning=$currentLearning&success=true&id=$formationId");
            exit();
        } else {
            // Redirige vers la même page avec un message d'erreur
            header("Location: index.php?page=learningProfile&learning=$currentLearning&error=true&id=$formationId");
            exit();
        }
    } else {
        // Redirige vers la page de connexion si l'utilisateur n'est pas connecté
        header('Location: index.php?page=login');
        exit();
    }
}

?>

<main style="min-height:90vh;">
    <div class="space"></div>

    <!-- Section pour une formation spécifique -->
    <div class="single-formation-container">
        <div class="single-formation-content">
            <h2><?= htmlspecialchars($selectedFormation['title']); ?></h2>

            <div class="single-formation-thumbnail">
                <img src="<?= htmlspecialchars($selectedFormation['thumbnail']); ?>" alt="Formation Thumbnail" style="width: 100%; height: auto;">
            </div>

            <div class="single-formation-details">
                <p><strong>Date:</strong> <?= htmlspecialchars($selectedFormation['date']); ?></p>
                <p><strong>Price:</strong> <?= htmlspecialchars($selectedFormation['price']); ?> €</p>
                <p><strong>Rating:</strong> <?= htmlspecialchars($selectedFormation['rate']); ?> / 5</p>
            </div>

            <div class="single-formation-description">
                <p><?= nl2br(htmlspecialchars($selectedFormation['description'])); ?></p>
            </div>
            <div class="single-formation-actions">
                <?php if (isset($_SESSION['pseudo'])) { ?>
                    <form action="index.php?page=learningProfile&learning=<?= htmlspecialchars($selectedFormation['title']); ?>" method="post">
                        <input type="hidden" name="formation_id" value="<?= htmlspecialchars($selectedFormation['id_learning']); ?>">
                        <button type="submit" class="btn-enroll">S'inscrire</button>
                    </form>
                <?php } else { ?>
                    <p>Vous devez vous connecter pour vous inscrire à cette formation.</p>
                    <a href="index.php?page=login" class="btn-login">Se connecter</a>
                <?php } ?>
                <a href="index.php?page=learn" class="btn-learn">Retour aux formations</a>
            </div>

        </div>
    </div>
    <?php if (isset($_GET['success']) && $_GET['success'] === 'true'): ?>
        <div class="alert alert-success">
            Inscription réussie ! Vous êtes maintenant inscrit à cette formation.
        </div>
    <?php elseif (isset($_GET['error']) && $_GET['error'] === 'true'): ?>
        <div class="alert alert-danger">
            Une erreur est survenue lors de l'inscription. Veuillez réessayer.
        </div>
    <?php endif; ?>

</main>