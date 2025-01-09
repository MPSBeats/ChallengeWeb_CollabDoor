<?php

require_once '../models/learnsModel.php';
require_once '../models/userModel.php';

$learning = new Learn();
$user = new User();

// Check if a specific formation is selected
if (isset($_GET['learning'])) {
    $selectedFormation = $learning->getLearningById($_GET['learning']);
    $currentLearning = $title = htmlspecialchars($selectedFormation['title']);
} else {
    header('Location: index.php?page=formations'); // Redirect if no formation is selected
    exit();
}



// Check if the user is enrolling in a course
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['formation_id'])) {
    if (isset($_SESSION['pseudo'])) {
        $userId = $user->getUserId($_SESSION['pseudo']); // Assuming the session contains the user ID
        $formationId = $_POST['formation_id'];
        $isEnrolled = $learning->insertUserLearning($userId, $formationId);

        if ($isEnrolled) {
            // Redirect to the same page with a success message
            header("Location: index.php?page=learningProfile&learning=$currentLearning&success=true&id=$formationId");
            exit();
        } else {
            // Redirect to the same page with an error message

            header("Location: index.php?page=learningProfile&learning=$currentLearning&error=true&id=$formationId");
            exit();
        }
            } else {
        // Redirect to login if not logged in
        header('Location: index.php?page=login');
        exit();
    }
}

?>


<main style="min-height:90vh;">
    <div class="space"></div>

    <!-- Section for a Single Formation -->
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