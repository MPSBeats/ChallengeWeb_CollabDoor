<?php
// Vérifie si la requête est de type POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Si le bouton de déconnexion est cliqué
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

$db = (new Database())->connect();

// Récupère les informations du profil en fonction de l'artiste ou de l'utilisateur connecté
if (isset($_GET['artist'])) {
    $profilePicture = $profil->getPicture($_GET['artist']);
    $collabs = $profil->getAllCollabs($_GET['artist']);
    $formations = $profil->getAllLearningsByUser($_GET['artist']);
    $pseudo = $_GET['artist'];
} else {
    $profilePicture = $profil->getPicture($_SESSION['pseudo']);
    $collabs = $profil->getAllCollabs($_SESSION['pseudo']);
    $formations = $profil->getAllLearningsByUser($_SESSION['pseudo']);
    $pseudo = $_SESSION['pseudo'];
}

// Vérifie si un utilisateur est sélectionné pour le chat
if (isset($_GET['user'])) {
    $selectedUser = strtolower($_GET['user']);
    $showChatBox = true; // Affiche la chatbox si un utilisateur est sélectionné
} else {
    $showChatBox = false; // Cache la chatbox par défaut
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

            <!-- Conteneur pour les vignettes dynamiques -->
            <div class="squares-container">
                <!-- Affiche toutes les vignettes par défaut (collabs et formations) -->
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

        <!-- Boîte de profil -->
        <div class="profile-box">
            <div class="profile-header">
                <div class="profile-picture">
                    <img src="<?= htmlspecialchars($profilePicture['picture']); ?>" alt="Profile Picture" class="profile-img">
                </div>
                <div class="profile-info">
                    <h2><?php echo $pseudo; ?></h2>
                </div>
            </div>
            <div class="profile-actions">
                <?php if (!isset($_GET['artist'])) { ?>
                    <form action="index.php?page=profile" method="post" class="btn-profil">
                        <button type="submit" name='collab' class="btn-blue">Ajouter une collab</button>
                    </form>
                    <form action="index.php?page=profile" method="post" class="btn-profil">
                        <button type="submit" name="logout" class="btn-red">Déconnexion</button>
                    </form>
                    <form action="index.php?page=message" method="post" class="btn-profil">
                        <button type="submit" name="message" class="btn-green">Message</button>
                    </form>
                <?php } else { ?>
                    <div class="btn-profil">
                        <button onclick="window.location.href='index.php?page=profile&artist=<?php echo $pseudo ?>&user=<?php echo $pseudo; ?>'" class="btn-green">Contacter</button>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>

    <?php
    // Affichage de la chatBox
    if ($showChatBox): ?>
        <div class="chat-box" id="chat-box">
            <div class="chat-box-header">
                <h2><?php echo ucfirst($selectedUser); ?></h2>
                <button class="close-btn" onclick="closeChat()">✖</button>
            </div>
            <div class="chat-box-body" id="chat-box-body">
                <!-- Les messages du chat seront chargés ici -->
            </div>
            <form class="chat-form" id="chat-form">
                <input type="hidden" id="sender" value="<?php echo htmlspecialchars($_SESSION['pseudo']); ?>">
                <input type="hidden" id="receiver" value="<?php echo $selectedUser; ?>">
                <input type="text" id="message" placeholder="Tapez votre message..." required>
                <button type="submit">Envoyer</button>
            </form>
        </div>
    <?php endif; ?>
</main>

<script>
    // Ajoute des écouteurs d'événements aux options en haut
    document.querySelectorAll('.option').forEach(option => {
        option.addEventListener('click', function() {
            const action = this.getAttribute('data-action');
            const squares = document.querySelectorAll('.square');
            const squaresContainer = document.querySelector('.squares-container');

            if (action === 'samples') {
                // Pour l'instant, affiche seulement les 3 premières vignettes
                squares.forEach((square, index) => {
                    if (index < 3) {
                        square.style.display = 'block'; // Affiche les 3 premières vignettes
                        square.style.width = '30%'; // Ajuste la largeur
                        square.style.height = '25vh'; // Ajuste la hauteur
                    } else {
                        square.style.display = 'none'; // Cache le reste
                    }
                });
            } else {
                // Réinitialise et affiche toutes les vignettes
                squares.forEach(square => {
                    square.style.display = 'block'; // Affiche toutes les vignettes
                    square.style.width = '30%'; // Réinitialise la largeur
                    square.style.height = '25vh'; // Réinitialise la hauteur
                });

                // Ajuste les couleurs ou les styles pour des options spécifiques
                if (action === 'collabs') {
                    // Affiche seulement les vignettes de collaboration
                    document.querySelectorAll('.collab').forEach(square => square.style.display = 'block');
                    document.querySelectorAll('.formation').forEach(square => square.style.display = 'none');
                    document.querySelectorAll('.sample').forEach(square => square.style.display = 'none');
                } else if (action === 'formations') {
                    // Affiche seulement les vignettes de formation
                    document.querySelectorAll('.formation').forEach(square => square.style.display = 'block');
                    document.querySelectorAll('.collab').forEach(square => square.style.display = 'none');
                    document.querySelectorAll('.sample').forEach(square => square.style.display = 'none');
                }
            }
        });
    });

    // Simule un clic sur l'option "collabs" lorsque la page se charge
    document.querySelector('.option[data-action="collabs"]').click();
</script>

<?php
// Script pour gérer la chat box sur le profil d'un utilisateur
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    function closeChat() {
        document.getElementById("chat-box").style.display = "none";
    }

    function fetchMessages() {
        var sender = $('#sender').val();
        var receiver = $('#receiver').val();

        console.log("Sender: " + sender);
        console.log("Receiver: " + receiver);

        // Sauvegarde la position actuelle du défilement
        var chatBox = $('#chat-box-body');
        var scrollTop = chatBox.scrollTop();
        var scrollHeight = chatBox.prop("scrollHeight");

        $.ajax({
            url: 'index.php?page=fetch_messages',
            type: 'POST',
            data: {
                sender: sender,
                receiver: receiver
            },
            success: function(data) {
                $('#chat-box-body').html(data);

                // Réinitialise la position du défilement uniquement si l'utilisateur était en bas de la boîte de chat
                if (scrollTop + chatBox.outerHeight() >= scrollHeight) {
                    scrollChatToBottom();
                } else {
                    chatBox.scrollTop(scrollTop);
                }
            }
        });
    }

    function scrollChatToBottom() {
        var chatBox = $('#chat-box-body');
        chatBox.scrollTop(chatBox.prop("scrollHeight"));
    }

    $(document).ready(function() {
        // Récupère les messages pour l'utilisateur sélectionné lorsque la page se charge
        fetchMessages();

        // Récupère les messages toutes les 3 secondes
        setInterval(fetchMessages, 3000);

        // Soumet le message du chat
        $('#chat-form').submit(function(e) {
            e.preventDefault();
            var sender = $('#sender').val();
            var receiver = $('#receiver').val();
            var message = $('#message').val();

            $.ajax({
                url: 'index.php?page=submit_message',
                type: 'POST',
                data: {
                    sender: sender,
                    receiver: receiver,
                    message: message
                },
                success: function() {
                    $('#message').val('');
                    fetchMessages(); // Récupère les messages après soumission
                }
            });
        });
    });
</script>
