<?php
require_once '../models/searchcollaborationModel.php';
require_once '../models/userModel.php';

$collaborationSheet = new SearchCollaboration();
$user = new User();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['create'])) {
        $title = htmlspecialchars($_POST['title']);
        $thumbnail = htmlspecialchars($_POST['thumbnail']);

        if (empty($title) || empty($thumbnail)) {
            $error = 'Veuillez remplir tous les champs';
        } else {

            if ($id = $collaborationSheet->createSearchCollaboration($title, $thumbnail)) {
                $user_id = $user->getUserId($_SESSION['pseudo']);
                if ($collaborationSheet->createUserSearchCollaboration($user_id, $id)) {
                    $succes = 'Collaboration créée !';
                } else {
                    $error = 'Une erreur est survenue lors de la création de la collaboration';
                };
            } else {
                $error = 'Une erreur est survenue lors de la création de la collaboration';
            }
        }
    }
}
?>

<main>
    <div class="space"></div>
    <form action="index.php?page=collaborationsheet" method="post">
        <div class="form-box" id="form">
            <h3>Créer une fiche recherche de collaboration :</h3>
            <input type="text" name="title" id="title" placeholder="Titre" required>
            <input type="file" name="thumbnail" id="thumbnail" accept="image/png, image/jpeg" required>
            <div class="btn-box">
                <button type='submit' name='create'>Créer</button>
            </div>
        </div>
    </form>
</main>