<?php
require_once "../models/database.php";

$db = (new Database())->connect();

$sender = strtolower($_POST['sender']);
$receiver = strtolower($_POST['receiver']);
$message = $_POST['message'];

// Récupérer l'ID de l'expéditeur
$senderStmt = $db->prepare("SELECT id_user FROM Users WHERE LOWER(pseudo) = :pseudo");
$senderStmt->execute([':pseudo' => $sender]);
$senderId = $senderStmt->fetch(PDO::FETCH_COLUMN);

// Récupérer l'ID du destinataire
$receiverStmt = $db->prepare("SELECT id_user FROM Users WHERE LOWER(pseudo) = :pseudo");
$receiverStmt->execute([':pseudo' => $receiver]);
$receiverId = $receiverStmt->fetch(PDO::FETCH_COLUMN);

// Insérer le message dans la base de données
$sql = "INSERT INTO Chats (sender, receiver, message, created_at) VALUES (:sender, :receiver, :message, NOW())";
$result = $db->prepare($sql);
$result->execute([':sender' => $senderId, ':receiver' => $receiverId, ':message' => $message]);
?>
