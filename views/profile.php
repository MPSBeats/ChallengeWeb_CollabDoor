<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['logout'])) {
        session_destroy();
        header('Location: index.php?page=home');
        exit();
    } elseif (isset($_POST['collab'])) {
        header('Location: index.php?page=collaborationsheet');
        exit();
    }
}

require_once '../models/profileModel.php';
$profil = new Profile();

if (isset($_GET['artist'])) {
    $profilePicture = $profil->getPicture($_GET['artist']);
    $collabs = $profil->getAllCollabs($_GET['artist']);
    $formations = $profil->getAllMasterclass($_GET['artist']);
    $pseudo = $_GET['artist'];
} else {
    $profilePicture = $profil->getPicture($_SESSION['pseudo']);
    $collabs = $profil->getAllCollabs($_SESSION['pseudo']);
    $formations = $profil->getAllMasterclass($_SESSION['pseudo']);
    $pseudo = $_SESSION['pseudo'];
}
?>

<main class="profil">
    <div class="space"></div>

    <div class="profile-container">
        <div class="profile-content">
            <div class="options-container">
                <div class="option" data-action="samples">
                    <h3>Mes Samples</h3>
                </div>
                <div class="option" data-action="collabs">
                    <h3>Mes Collabs</h3>
                </div>
                <div class="option" data-action="formations">
                    <h3>Mes Formations</h3>
                </div>
            </div>

            <!-- Container for dynamic thumbnails -->
            <div class="squares-container">
                <!-- Render all thumbnails by default (collabs and formations) -->
                <?php foreach ($collabs as $index => $collab): ?>
                    <div class="square collab" style="width: 100%;">
                        <img src="<?= htmlspecialchars($collab['thumbnail']); ?>" alt="Collab Thumbnail" style="width: 100%; height: 100%;">
                    </div>
                <?php endforeach; ?>


                <?php foreach ($formations as $index => $formation): ?>
                    <div class="square formation" style="z-index: 10;background-image: url('<?= htmlspecialchars($formation['thumbnail']); ?>');"></div>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- Profile Box -->
        <div class="profile-box">
            <div class="profile-header">
                <div class="profile-picture">
                    <img src="<? $profilePicture ?>" alt="Profile Picture" class="profile-img">
                </div>
                <div class="profile-info">
                    <h2><?php echo $pseudo; ?></h2>
                </div>
            </div>
            <div class="profile-actions">
                <?php if (!isset($_GET['artist'])) { ?>
                    <form action="index.php?page=profile" method="post" class="collab-form">
                        <button type="submit" name='collab' class="btn-blue">Ajouter une collab</button>
                    </form>
                    <form action="index.php?page=profile" method="post" class="logout-form">
                        <button type="submit" name="logout" class="btn-red">Logout</button>
                    </form>

                <?php } else { ?>
                    <button class="btn-green">Contacter</button>
                <?php } ?>
            </div>
        </div>
    </div>
</main>

<script>
    // Add event listeners to the top options
    document.querySelectorAll('.option').forEach(option => {
        option.addEventListener('click', function() {
            const action = this.getAttribute('data-action');
            const squares = document.querySelectorAll('.square');
            const squaresContainer = document.querySelector('.squares-container');

            if (action === 'samples') {


                // For now, just showing the first 3 squares
                squares.forEach((square, index) => {
                    if (index < 3) {
                        square.style.display = 'block'; // Show the first 3 squares
                        square.style.width = '30%'; // Adjust width
                        square.style.height = '25vh'; // Adjust height
                    } else {
                        square.style.display = 'none'; // Hide the rest
                    }
                });
            } else {
                // Reset and show all squares
                squares.forEach(square => {
                    square.style.display = 'block'; // Show all squares
                    square.style.width = '30%'; // Reset width
                    square.style.height = '25vh'; // Reset height
                });

                // Adjust colors or styles for specific options
                if (action === 'collabs') {
                    // Show only collaboration squares
                    document.querySelectorAll('.collab').forEach(square => square.style.display = 'block');
                    document.querySelectorAll('.formation').forEach(square => square.style.display = 'none');
                    document.querySelectorAll('.sample').forEach(square => square.style.display = 'none');


                } else if (action === 'formations') {
                    // Show only formation squares
                    document.querySelectorAll('.formation').forEach(square => square.style.display = 'block');
                    document.querySelectorAll('.collab').forEach(square => square.style.display = 'none');
                    document.querySelectorAll('.sample').forEach(square => square.style.display = 'none');
                }
            }
        });
    });

    // Simulate a click on the "collabs" option when the page loads
    document.querySelector('.option[data-action="collabs"]').click();
</script>