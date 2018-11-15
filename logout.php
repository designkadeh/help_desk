<?php

require_once "Database.php";
$db = new Database();

if (isset($_POST['action']) && $_POST['action'] == "logout") {
    session_start();
    session_unset();
    unset($_SESSION['id']);
    unset($_SESSION['username']);
    unset($_SESSION['password']);
    session_destroy();
    echo "success";
}
else {
    $db->logout(array('id','username','password'));
}