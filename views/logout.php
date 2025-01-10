<?php
/**
 * Ce fichier gère la déconnexion de l'utilisateur.
 * 
 * - Démarre une nouvelle session ou reprend une session existante.
 * - Détruit toutes les données associées à la session actuelle.
 * - Redirige l'utilisateur vers la page d'accueil de la bibliothèque.
 * 
 * @file logout.php
 */
?>
<?php
session_start();
session_destroy();
header("Location: bibliotheque/index.php");
exit();
?>