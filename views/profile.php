<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    session_destroy();
    header('Location: index.php?page=home');
    exit();
}

require_once '../models/profileModel.php';
$profil = new Profile();
$profilePicture = $profil->getPicture($_SESSION['pseudo']);
$collabs = $profil->getAllCollabs($_SESSION['pseudo']);
$formations = $profil->getAllMasterclass($_SESSION['pseudo']);
?>

<main>
    <div class="space"></div>

    <div class="flex w-full justify-around">
        <div class="bg-blue-500 w-3/5 h-auto">
            <div class="flex flex-wrap">
                <div class="option w-1/3 h-10vh bg-red-500 flex items-center justify-center cursor-pointer" data-action="samples">Mes Samples</div>
                <div class="option w-1/3 h-10vh bg-red-500 flex items-center justify-center cursor-pointer" data-action="collabs">Mes Collabs</div>
                <div class="option w-1/3 h-10vh bg-red-500 flex items-center justify-center cursor-pointer" data-action="formations">Mes Formations</div>
            </div>

            <!-- Container for dynamic thumbnails -->
            <div class="squares-container flex flex-wrap justify-center gap-8">
                <!-- Render all thumbnails by default (collabs and formations) -->
                <?php foreach ($collabs as $index => $collab): ?>
                    <div class="square collab h-5vh w-1/3 bg-cover bg-center mb-2" style="background-image: url('<?= htmlspecialchars($collab['thumbnail']); ?>');"></div>
                <?php endforeach; ?>

                <?php foreach ($formations as $index => $formation): ?>
                    <div class="square formation h-5vh w-1/3 bg-cover bg-center mb-2" style="background-image: url('<?= htmlspecialchars($formation['thumbnail']); ?>');"></div>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- Profile Box -->
        <div class="border-2 border-black rounded-lg w-1/3 h-65vh p-2.5">
            <div class="flex justify-between">
                <div class="w-25vh h-25vh overflow-hidden rounded-full">
                    <img src="<? $profilePicture ?>" alt="Profile Picture" class="w-full h-full object-cover">
                </div>
                <div class="w-35vh h-25vh flex items-center justify-center flex-col">
                    <h2><?php echo $_SESSION['pseudo']; ?></h2>
                    <div class="flex justify-around">
                        <p>5*</p>
                        <p>|</p>
                        <p>Paris</p>
                    </div>
                </div>
            </div>
            <div class="w-full h-25vh">
                <h2>Bio</h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quisquam, quod.</p>
                <div class="flex">
                    <p>Trap,</p>
                    <p>RNB,</p>
                    <p>NEW WAVE</p>
                </div>
            </div>
            <div class="flex justify-center items-center h-15vh">
                <button class="bg-green-500 p-2.5 rounded-full text-center text-white w-1/2">Rounded Button</button>
                <form action="index.php?page=profile" method="post" class="h-15vh w-1/2 flex items-center">
                    <button type="submit" class="bg-red-500 p-2.5 rounded-full text-white w-full">Logout</button>
                </form>
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
                const sampleSquares = document.querySelectorAll('.sample');
                sampleSquares.forEach(square => square.style.display = 'block');
            } else {
                // Reset and show all squares
                squares.forEach(square => {
                    square.style.display = 'block';  // Show all squares
                    square.style.width = '30%';  // Reset width
                    square.style.height = '25vh';  // Reset height
                });

                // Adjust colors or styles for specific options
                if (action === 'collabs') {
                    // Show only collaboration squares
                    document.querySelectorAll('.collab').forEach(square => square.style.display = 'block');
                    document.querySelectorAll('.formation').forEach(square => square.style.display = 'none');
                } else if (action === 'formations') {
                    // Show only formation squares
                    document.querySelectorAll('.formation').forEach(square => square.style.display = 'block');
                    document.querySelectorAll('.collab').forEach(square => square.style.display = 'none');
                }
            }
        });
    });

    // Simulate a click on the "collabs" option when the page loads
    document.querySelector('.option[data-action="collabs"]').click();
</script>
