<?php
session_start();
require_once "Database.php";
$db = new Database();
    if ($_SESSION['username']) {
        require "view/header.php";
        require"view/panel.php";
        require "view/footer.php";
    }
    else {
        $db->redirectMethod('index.php');
    }