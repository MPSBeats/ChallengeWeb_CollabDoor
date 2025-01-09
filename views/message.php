<main>
    <div class="space"></div>

    <?php
session_start();
require_once "../models/database.php";

$db = (new Database())->connect();

if (!isset($_SESSION['pseudo'])) {
    header("Location: index.php?page=login");
    exit();
}

$pseudo = $_SESSION['pseudo'];
$selectedUser = '';

if (isset($_GET['user'])) {
    $selectedUser = $_GET['user'];
    $showChatBox = true; // Set to true only when a user is selected
} else {
    $showChatBox = false; // Set to false initially
}

?>

<div class="account-info">
    <div class="welcome">
        <h2>Bienvenue, <?php echo ucfirst($pseudo); ?>!</h2>
    </div>
    <div class="user-list">
        <h2>Choisi un artiste avec qui discuter:</h2>
        <ul>
            <?php 
            // Simplification de la requête pour tester si des utilisateurs sont retournés
            $sql = "SELECT pseudo FROM Users WHERE pseudo != :pseudo";  // Sélectionner tous les utilisateurs sauf l'utilisateur actuel
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':pseudo', $pseudo, PDO::PARAM_STR);
            $stmt->execute();
            $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if (count($users) > 0) {
                foreach ($users as $row) {
                    $user = $row['pseudo'];
                    $user = ucfirst($user);
                    echo "<li><a href='message.php?user=$user'>$user</a></li>";
                }
            } else {
                echo "<li>Aucun utilisateur trouvé.</li>";
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
        <input type="text" id="message" placeholder="Type your message..." required>
        <button type="submit">Send</button>
    </form>
</div>
<?php endif; ?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
// Chat functionalities
function closeChat() {
    document.getElementById("chat-box").style.display = "none";
}

function fetchMessages() {
    var sender = $('#sender').val();
    var receiver = $('#receiver').val();

    $.ajax({
        url: 'fetch_messages.php',
        type: 'POST',
        data: {sender: sender, receiver: receiver},
        success: function(data) {
            $('#chat-box-body').html(data);
            scrollChatToBottom();
        }
    });
}

function scrollChatToBottom() {
    var chatBox = $('#chat-box-body');
    chatBox.scrollTop(chatBox.prop("scrollHeight"));
}

$(document).ready(function() {
    fetchMessages();
    setInterval(fetchMessages, 3000);

    $('#chat-form').submit(function(e) {
        e.preventDefault();
        var sender = $('#sender').val();
        var receiver = $('#receiver').val();
        var message = $('#message').val();

        $.ajax({
            url: 'submit_message.php',
            type: 'POST',
            data: {sender: sender, receiver: receiver, message: message},
            success: function() {
                $('#message').val('');
                fetchMessages();
            }
        });
    });
});
</script>




</main>