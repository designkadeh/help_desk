<?php
if ($_SERVER['REQUEST_METHOD'] === "GET") {
    if (isset($_GET['block'])) {
        $query = "UPDATE `Users` SET `user_status_id` = ? WHERE `user_id` = ?";
        $param = "";
        if ($_SESSION['roll_id'] == 1) {
            $param = 3;
        }
        if ($_SESSION['roll_id'] == 2) {
            $param = 2;
        }
        $params = [$param,$_GET['block']];
        $result = $db->curdMethod($query,$params);
        if ($result) {
            $db->redirectMethod($db->internalUrl("")."/panel.php?block_response=".md5(sha1("success")));
        }
        else {
            $db->redirectMethod($db->internalUrl("")."/panel.php?unblock_response=".md5(sha1("error")));
        }
    }
    if (isset($_GET['unblock'])) {
        $query = "UPDATE `Users` SET `user_status_id` = ? WHERE `user_id` = ?";
        $params = [1,$_GET['unblock']];
        $result = $db->curdMethod($query,$params);
        if ($result) {
            $db->redirectMethod($db->internalUrl("")."/panel.php?unblock_response=".md5(sha1("success")));
        }
        else {
            $db->redirectMethod($db->internalUrl("")."/panel.php?unblock_response=".md5(sha1("error")));
        }
    }
}