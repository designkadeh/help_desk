<?php
session_start();
require_once "../../Database.php";
$db = new Database();

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    if (isset($_POST['update'])) {
        $name = $_POST['name'];
        $family = $_POST['family'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $address = $_POST['address'];
        if ($name !== "" && $family !== "" && $email !== "" && $phone !== "" && $address !== "") {
            if (!isset($_POST['dis'])) {
                $query = "UPDATE `Users` SET `name` = ?,`family` = ?,`email` = ?,`phone` = ?,`address` = ? WHERE `user_id` = '".$_SESSION['user_id']."' ";
                $params = [$name,$family,$email,$phone,$address];
                $update = $db->curdMethod($query,$params);
                if ($update) {
                    $db->redirectMethod($db->internalUrl("")."/panel.php?settings=".md5(sha1('success')));
                }
                else {
                    $db->redirectMethod($db->internalUrl("")."/panel.php?settings=".md5(sha1('error')));
                }
            }
            else {
                $db->redirectMethod($db->internalUrl("")."/panel.php?settings=".md5(sha1('change')));
            }
        }
        else {
            $db->redirectMethod($db->internalUrl("")."/panel.php?settings=".md5(sha1('free')));
        }
    }
    if (isset($_POST['change_password'])) {
        if ($_POST['old_pass'] !== "" && $_POST['new_pass'] !=="" && $_POST['renew_pass'] !== "") {
            $password = $db->realEscapeHtml($db->securityMethod($_POST['old_pass']));
            $new_pass = $db->realEscapeHtml($db->securityMethod($_POST['new_pass']));
            $renew = $db->realEscapeHtml($db->securityMethod($_POST['renew_pass']));
            $sel = $db->getRows("password","Users","user_id",$_SESSION['user_id']);
            $sel_pass = $sel[0]['password'];
            if ($sel_pass === $password) {
                if ($password === $new_pass) {
                    $db->redirectMethod($db->internalUrl("")."/panel.php?password=".sha1($_SESSION['user_id'])."&response=".md5("change"));
                }
                elseif ($new_pass === $renew) {
                    $q = "UPDATE `Users` SET `password` = ? WHERE `user_id` = ?";
                    $par = [$new_pass,$_SESSION['user_id']];
                    $up = $db->curdMethod($q,$par);
                    if ($up) {
                        $db->redirectMethod($db->internalUrl("")."/panel.php?password=".sha1($_SESSION['user_id'])."&response=".sha1("success"));
                    }
                    else {
                        $db->redirectMethod($db->internalUrl("")."/panel.php?password=".sha1($_SESSION['user_id'])."&response=".md5("error"));
                    }
                }
                else {
                    $db->redirectMethod($db->internalUrl("")."/panel.php?password=".sha1($_SESSION['user_id'])."&response=".md5("match"));
                }
            }
            else {
                $db->redirectMethod($db->internalUrl("")."/panel.php?password=".sha1($_SESSION['user_id'])."&response=".md5("password"));
            }

        }
        else {
            $db->redirectMethod($db->internalUrl("")."/panel.php?password=".sha1($_SESSION['user_id'])."&response=".md5("free"));
        }
    }
}