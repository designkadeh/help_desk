<?php
session_start();
require_once "../../Database.php";
$db = new Database();

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    if (isset($_POST['add_user'])) {
        $name = $db->realEscapeHtml($_POST['name']);
        $family = $db->realEscapeHtml($_POST['family']);
        $email = $db->realEscapeHtml($_POST['email']);
        $address = $db->realEscapeHtml($_POST['address']);
        $phone = $db->realEscapeHtml($_POST['phone']);
        $username = $db->realEscapeHtml($_POST['username']);
        $password = $db->realEscapeHtml($db->securityMethod($_POST['password']));
        $roll_id = $db->realEscapeHtml($_POST['roll_id']);
        $unit_id = $db->realEscapeHtml($_POST['unit_id']);
        if (($name && $family && $email && $address && $phone && $username && $password && $roll_id && $unit_id) != "") {
            $sel = $db->getRows('*','Users','username',$username);
            if ($sel) {
                $db->redirectMethod($db->internalUrl("")."/panel.php?adminuser=".sha1(md5("exist_user")));
            }
            else {
                $query = "INSERT INTO `Users`(`user_id`, `roll_id`, `unit_id`, `user_status_id`, `username`, `password`, `name`, `family`, `phone`, `address`, `email`) VALUES (?,?,?,?,?,?,?,?,?,?,?)";
                $params = [NULL,$roll_id,$unit_id,1,$username,$password,$name,$family,$phone,$address,$email];
                $result = $db->curdMethod($query,$params);
                if ($result) {
                    $db->redirectMethod($db->internalUrl("")."/panel.php?adminuser=".sha1(md5("success_user")));
                }
                else {
                    $db->redirectMethod($db->internalUrl("")."/panel.php?adminuser=".sha1(md5("error_user")));
                }
            }

        }
        else {
            $db->redirectMethod($db->internalUrl("")."/panel.php?user_free=".md5(sha1("free")));
        }
    }
    if (isset($_POST['add_unit'])) {
        $unit_id = $db->getRows('MAX(unit_id)','Units',1,1);
        $unit_id = $unit_id[0]['MAX(unit_id)'];
        $unit_id = $unit_id + 1;
        $unit_name = $db->realEscapeHtml($_POST['unit_name']);
        $sel = $db->getRows('*','Units','unit_name',$unit_name);
        if ($sel) {
            $db->redirectMethod($db->internalUrl("")."/panel.php?unit_response=".md5(sha1("exist_add_unit")));
        }
        else {
            $query = "INSERT INTO `Units`(`id`,`unit_id`,`unit_name`) VALUES (?,?,?)";
            $params = [NULL,$unit_id,$unit_name];
            $result = $db->curdMethod($query,$params);
            if ($result) {
                $db->redirectMethod($db->internalUrl("")."/panel.php?unit_response=".md5(sha1("add_unit")));
            }
            else {
                $db->redirectMethod($db->internalUrl("")."/panel.php?unit_response=".md5(sha1("err_add_unit")));
            }
        }

    }
}
else {
    $db->redirectMethod($db->internalUrl("")."/panel.php");
}