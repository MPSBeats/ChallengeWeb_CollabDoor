<?php

$page = (isset($_GET['page'])) ? $_GET['page'] : 'home';




switch ($page) {
    case 'home':
        include '../views/home.php';
        break;

    case 'collaborate':
        include '../views/collaborate.php';
        break;

    case 'discover':
        include '../views/discover.php';
        break;

    case 'learn':
        include '../views/learn.php';
        break;


    case 'login':
        include '../views/login.php';
        break;

    case 'register':
        include '../views/register.php';
        break;

    case 'profile':
        include '../views/profile.php';
        break;

    default:
        break;
}
