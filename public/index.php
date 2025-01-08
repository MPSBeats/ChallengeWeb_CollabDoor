<?php

include "../models/database.php";
$db = new Database();
$db->connect();
include "../views/partials/header.php";
include "../controllers/mainController.php";
include "../views/partials/footer.php";
