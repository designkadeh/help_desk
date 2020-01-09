<?php
session_start();
require_once "Database.php";
$db = new Database();
$error = "";
$success = "";
if (isset($_POST['action']) && $_POST['action'] == "register") {
    $username = $db->realEscapeHtml($_POST['username']);
    $name = $db->realEscapeHtml($_POST['name']);
    $family = $db->realEscapeHtml($_POST['family']);
    $phone = $db->realEscapeHtml($_POST['phone']);
    $address = $db->realEscapeHtml($_POST['address']);
    $email = $db->realEscapeHtml($_POST['email']);
    $password = $db->realEscapeHtml($db->securityMethod($_POST['password']));
    $sel = $db->getRows('*','Users','username',$username);
    if (!$sel) {
        $query = "INSERT INTO `Users`(`user_id`, `roll_id`, `unit_id`, `user_status_id`, `username`, `password`, `name`, `family`, `phone`, `address`, `email`) VALUES (?,?,?,?,?,?,?,?,?,?,?)";
        $params = [NULL,3,5,1,$username,$password,$name,$family,$phone,$address,$email];
        $ins = $db->curdMethod($query,$params);
        if ($ins) {
            echo "success";
        }
    }
    else {
        echo "Username";
    }
}
else {
    if ($_SERVER['REQUEST_METHOD'] === "POST") {
        if (isset($_POST['register'])) {
            $ops = $_POST['ops'];
            $username = $db->realEscapeHtml($ops['username']);
            $password = $db->realEscapeHtml($db->securityMethod($ops['password']));
            if ($username == "") {
                $error = "<br/>نام کاربری شما خالی است";
            }
            elseif ($password == "") {
                $error = "رمز عبور شما خالی است.";
            }
            elseif (($username && $password) == "") {
                $error = "نام کاربری و رمز عبور شما خالی است.";
            }
            else {
                $sel = $db->getRows('*','Users','username',$username);
                if (!$sel) {
                    $insert = $db->curdMethod("INSERT INTO `Users`(`user_id`, `roll_id`, `user_status_id`, `username`, `password`, `name`, `family`, `phone`, `address`, `email`) VALUES (NULL ,1,3,'".$username."','".$password."','','','','','')");
                    if ($insert) {
                        $success = "با موفقیت ثبت شد";
                    }
                    else {
                        $error = "در ثبت اطلاعات مشکلی پیش آمد لطفا مجدد سعی کنید";
                    }
                }
                else {
                    $error = "نام کاربری انتخابی شما وجود دارد.";
                }
            }
        }
    }
}
