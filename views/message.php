<?php

require_once "../models/database.php";

$db = (new Database())->connect();

if (!isset($_SESSION['pseudo'])) {
    header("Location: index.php?page=login");
    exit();
}

$pseudo = strtolower($_SESSION['pseudo']);
$selectedUser = '';

if (isset($_GET['user'])) {
    $selectedUser = strtolower($_GET['user']);
    $showChatBox = true; // Set to true only when a user is selected
} else {
    $showChatBox = false; // Set to false initially
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
                    // Fetch all users except the current user
                    $sqlMessage = "SELECT DISTINCT u2.pseudo FROM Users u1 JOIN UsersChats uc ON u1.id_user = uc.id_userchat JOIN Chats c ON uc.id_userchat::varchar = c.sender::varchar OR uc.id_userchat::varchar = c.receiver::varchar JOIN Users u2 ON (c.sender::varchar = u2.id_user::varchar OR c.receiver::varchar = u2.id_user::varchar) WHERE u1.pseudo = :pseudo AND u1.id_user <> u2.id_user";
                    $resultMessage = $db->prepare($sqlMessage);
                    $resultMessage->execute([':pseudo' => $pseudo]);
                    $users = $resultMEssage->fetchAll(PDO::FETCH_ASSOC);

                    if (count($users) > 0) {
                        foreach ($users as $row) {
                            $user = $row['pseudo'];
                            $user = ucfirst($user);
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
                    <button class="close-btn" onclick="closeChat()">✖</button>
                </div>
                <div class="chat-box-body" id="chat-box-body">
                    <!-- Chat messages will be loaded here -->
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
            // Fetch messages for the selected user when the page loads
            fetchMessages();

            // Fetch messages every 3 seconds
            setInterval(fetchMessages, 3000);

            // Submit the chat message
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
                        fetchMessages(); // Fetch messages after submitting
                    }
                });
            });
        });
    </script>
</body>

</html>