<?php
session_start();
require_once "../../Database.php";
$db = new Database();
if ($_SERVER['REQUEST_METHOD'] === "POST") {
    if (isset($_POST['add_ticket'])) {
        $title = $db->realEscapeHtml($_POST['message_title']);
        $unit_id = $db->realEscapeHtml($_POST['unit_id']);
        $priority_id = $db->realEscapeHtml($_POST['priority_id']);
        $message = $db->realEscapeHtml($_POST['message']);
        $user_id = $_SESSION['user_id'];
        $time = date('Y-m-d H:i:s');
        if ($title === "" || $unit_id === "" || $priority_id === "" || $message === "") {
            $db->redirectMethod($db->internalUrl("")."/panel.php?add_ticket=".md5(sha1("free")));
        }
        else {
            $query = "INSERT INTO `Messages`(`message_id`, `user_id`, `unit_id`, `reply_id`, `message_status_id`, `priority_id`, `timestamp`, `message_title`, `message`) VALUES (?,?,?,?,?,?,?,?,?)";
            $params = [NULL,$user_id,$unit_id,NULL,1,$priority_id,$time,$title,$message];
            $result = $db->curdMethod($query,$params);
            if ($result) {
                $db->redirectMethod($db->internalUrl("")."/panel.php?add_ticket=".md5(sha1("success")));
            }
            else {
                $db->redirectMethod($db->internalUrl("")."/panel.php?add_ticket=".md5(sha1("error")));
            }
        }

    }
}