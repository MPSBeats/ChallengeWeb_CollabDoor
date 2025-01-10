<?php
require_once "database.php";

$db = (new Database())->connect();

$sender = strtolower($_POST['sender']);
$receiver = strtolower($_POST['receiver']);

// Vérifiez que les pseudo de l'expéditeur et du destinataire sont définis
if (!$sender || !$receiver) {
    echo "L'expéditeur et le destinataire doivent être définis.";
    exit();
}

// Récupérer l'ID de l'expéditeur
$senderStmt = $db->prepare("SELECT id_user FROM Users WHERE LOWER(pseudo) = :pseudo");
$senderStmt->execute([':pseudo' => $sender]);
$senderId = $senderStmt->fetch(PDO::FETCH_COLUMN);

// Récupérer l'ID du destinataire
$receiverStmt = $db->prepare("SELECT id_user FROM Users WHERE LOWER(pseudo) = :pseudo");
$receiverStmt->execute([':pseudo' => $receiver]);
$receiverId = $receiverStmt->fetch(PDO::FETCH_COLUMN);

// Vérifiez que les IDs de l'expéditeur et du destinataire sont valides
if (!$senderId) {
    echo "ID de l'expéditeur n'est pas valide pour le pseudo: $sender";
    exit();
}
if (!$receiverId) {
    echo "ID du destinataire n'est pas valide pour le pseudo: $receiver";
    exit();
}

// Sélectionner les messages entre l'expéditeur et le destinataire
$sql = "SELECT * FROM Chats WHERE (sender = :sender AND receiver = :receiver) OR (sender = :receiver AND receiver = :sender) ORDER BY created_at ASC";
$result = $db->prepare($sql);
$result->execute([':sender' => $senderId, ':receiver' => $receiverId]);
$messages = $result->fetchAll(PDO::FETCH_ASSOC);

// Afficher les messages
foreach ($messages as $message) {
    $senderName = ($message['sender'] == $senderId) ? $sender : $receiver;
    echo "<div class='message'><strong>{$senderName}:</strong> {$message['message']}</div>";
}
?>

<script>
    var chatBox = document.querySelector(".chat-box");
    var header = chatBox.querySelector("header");
    var footer = chatBox.querySelector("footer");

    header.style.display = "none";
    footer.style.display = "none";
</script>