<?php

require_once "../models/database.php";
require_once "../models/chatboxModel.php";

// Connexion à la base de données et récupération des messages des utilisateurs
$db = (new Database())->connect();
$users = new Chatbox();
$userMessage = $users->fetchMessageUsers($_SESSION['pseudo']);

// Redirection vers la page de connexion si l'utilisateur n'est pas connecté
if (!isset($_SESSION['pseudo'])) {
    header("Location: index.php?page=login");
    exit();
}

$pseudo = strtolower($_SESSION['pseudo']);
$selectedUser = '';

// Vérification si un utilisateur est sélectionné pour afficher la boîte de chat
if (isset($_GET['user'])) {
    $selectedUser = strtolower($_GET['user']);
    $showChatBox = true;
} else {
    $showChatBox = false;
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat Application</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <main class="messaging">
        <div class="space"></div>
        <div class="account-info">
            <div class="welcome">
                <h2>Bienvenue, <?php echo ucfirst($pseudo); ?>!</h2>
            </div>
            <div class="user-list">
                <h2>Choisi un artiste avec qui discuter:</h2>
                <ul>
                    <?php
                    // Affichage de la liste des utilisateurs avec qui discuter
                    if (count($userMessage) > 0) {
                        foreach ($userMessage as $row) {
                            $user = $row['pseudo'];
                            echo "<li><a href='index.php?page=message&user=$user'>$user</a></li>";
                        }
                    }
                    ?>
                </ul>
            </div>
        </div>

        <?php if ($showChatBox): ?>
            <div class="chat-box" id="chat-box">
                <div class="chat-box-header">
                    <h2><?php echo ucfirst($selectedUser); ?></h2>
                    <div class="chat-box-controls">
                        <p class="close-btn" onclick="closeChat()">✖</p>
                    </div>
                </div>
                <div class="chat-box-body" id="chat-box-body">
                    <!-- Les messages du chat seront chargés ici -->
                </div>
                <form class="chat-form" id="chat-form">
                    <input type="hidden" id="sender" value="<?php echo $pseudo; ?>">
                    <input type="hidden" id="receiver" value="<?php echo $selectedUser; ?>">
                    <input type="text" id="message" placeholder="Tapez votre message..." required>
                    <button type="submit">Envoyer</button>
                </form>
            </div>
        <?php endif; ?>
    </main>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        function closeChat() {
            document.getElementById("chat-box").style.display = "none";
        }

        function fetchMessages() {
            var sender = $('#sender').val();
            var receiver = $('#receiver').val();

            // Sauvegarder la position actuelle du défilement
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

                    // Réinitialiser la position du défilement uniquement si l'utilisateur était en bas de la boîte de chat
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
            // Charger les messages pour l'utilisateur sélectionné au chargement de la page
            fetchMessages();

            // Charger les messages toutes les 3 secondes
            setInterval(fetchMessages, 3000);

            // Soumettre le message du chat
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
                        fetchMessages(); // Charger les messages après soumission
                    }
                });
            });
        });
    </script>
</body>

</html>