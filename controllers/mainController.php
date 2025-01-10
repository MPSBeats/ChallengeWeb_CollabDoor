<?php

$page = (isset($_GET['page'])) ? $_GET['page'] : 'home';
$user = (isset($_GET['user'])) ? $_GET['user'] : '';


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

    case 'message':
        include '../views/message.php';
        break;

    case 'fetch_messages':
        include '../models/fetch_messages.php';
        break;

    case 'submit_message':
        include '../models/submit_message.php';
        break;

    case 'profile':
        include '../views/profile.php';
        break;

    case 'collaborationsheet':
        include '../views/collaborationsheet.php';
        break;

    case 'learningProfile':
        include '../views/learningProfile.php';
        break;

    case 'productsheet':
        include '../views/productsheet.php';
        break;

    case 'searchsheet':
        include '../views/searchsheet.php';
        break;


    default:
        include '../views/home.php';
        break;
}
