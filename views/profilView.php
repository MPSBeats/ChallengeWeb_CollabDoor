<?php
require_once '../models/database.php';
$db = (new Database())->connect();

$id = (int) $_GET['id']; // Convertir en entier pour éviter les injections SQL

    $profilsql = "SELECT * FROM users WHERE id_user = $id";
    $resultprofil = $db->prepare($profilsql);
    $resultprofil->execute();
    $profils = $resultprofil->fetchAll(PDO::FETCH_ASSOC);
    $profil = $profils[0] ?? null; // Accédez au premier élément du tableau



    // Requête pour récupérer les informations de l'utilisateur et les collaborations associées
    $sql = "
        SELECT u.*, c.id_collaborations, c.title, c.thumbnail, c.published_at
        FROM users u
        LEFT JOIN usercollaborations uc ON u.id_user = uc.id_user
        LEFT JOIN collaborations c ON uc.id_collaborations = c.id_collaborations
        WHERE u.id_user = :id
    ";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $result = $results[0] ?? null; // Accédez au premier élément du tableau
?>


<main>
<div class="space"></div>
    <div class="profile-container">
        <div class="profile-content">
            <div class="options-container">
                <div class="option" data-action="samples">
                    <h3>Samples</h3>
                </div>
                <div class="option" data-action="collabs">
                    <h3>Collabs</h3>
                    <?php foreach($results as $result){ ?>
                    <article class="oeuvre" onclick="window.location.href='index.php?page=productsheet&id=<?= $result['id_collaborations'] ?>'">
                            <img src="<?= htmlspecialchars($result['thumbnail']) ?>" alt="">
                            <div>
                                <h4><?= htmlspecialchars($result['title']) ?></h4>
                                <p>Publié le : <?= htmlspecialchars($result['published_at']) ?></p>
                            </div>
                    </article>
                    <?php } ?>
                </div>
                <div class="option" data-action="formations">
                    <h3>Formations</h3>
                </div>
            </div>

        </div>
            <!-- Profile Box -->
        <div class="profile-box">
            <div class="profile-header">
                <div class="profile-picture">
                    <img src="<?= htmlspecialchars($profil['picture']) ?>" alt="Profile Picture" class="profile-img">
                </div>
                <div class="profile-info">
                    <h2><?php echo $profil['pseudo']; ?></h2>
                </div>
            </div>
            <div>
                
            </div>
        </div>
    </div>
   <?php var_dump($profils); ?>

</main>