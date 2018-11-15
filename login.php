<?php
session_start();
require_once "Database.php";
$db = new Database();
$username = $db->realEscapeHtml($_POST['username']);
$password = $db->realEscapeHtml($db->securityMethod($_POST['password']));
$login = $db->loginMethod('Users','username','password',$username,$password);

if ($login) {

    $_SESSION['id'] = $login['user_id'];
    $_SESSION['username'] = $login['username'];
    $_SESSION['user_id'] = $login['user_id'];
    $_SESSION['roll_id'] = $login['roll_id'];
    $_SESSION['user_status_id'] = $login['user_status_id'];
    $_SESSION['unit_id'] = $login['unit_id'];

    echo "1";
}
else {
    echo "0";
}