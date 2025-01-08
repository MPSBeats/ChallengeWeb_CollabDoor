<?php
session_start();

if (!isset($_SESSION['username'])) {
    exit("You are not logged in");
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Database connection (similar to chat.php)

    $sender = $_POST['sender'];
    $receiver = $_POST['receiver'];
    $message = $_POST['message'];

    $sql = "INSERT INTO chats (sender, receiver, message) VALUES ('$sender', '$receiver', '$message')";
    $db->query($sql);
    $db->close();
}


?>

<main>
    <div class="space"></div>
</main>