<?php
if ($_SERVER["REQUEST_METHOD"] === "GET") {
    if (isset($_GET['unblock_message'])) {
        $message_id = $db->realEscapeHtml($_GET['unblock_message']);
        $query = "UPDATE `Messages` SET `message_status_id` = ? WHERE `message_id` = ?";
        $params = [3,$message_id];
        $result = $db->curdMethod($query,$params);
        if ($result) {
            $db->redirectMethod($db->internalUrl("")."/panel.php?message=".md5(sha1("unblock")));
        }
        else {
            $db->redirectMethod($db->internalUrl("")."/panel.php?message=".md5(sha1("err_unblock")));
        }
    }
    if (isset($_GET['block_message'])) {
        $message_id = $db->realEscapeHtml($_GET['block_message']);
        $query = "UPDATE `Messages` SET `message_status_id` = ? WHERE `message_id` = ?";
        $params = [6,$message_id];
        $result = $db->curdMethod($query,$params);
        if ($result) {
            $db->redirectMethod($db->internalUrl("")."/panel.php?message=".md5(sha1("block")));
        }
        else {
            $db->redirectMethod($db->internalUrl("")."/panel.php?message=".md5(sha1("err_block")));
        }
    }
    if (isset($_GET['open'])) {
        $message_id = $db->realEscapeHtml($_GET['open']);
        $query = "UPDATE `Messages` SET `message_status_id` = ? WHERE `message_id` = ?";
        $params = [3,$message_id];
        $result = $db->curdMethod($query,$params);
        if ($result) {
            $db->redirectMethod($db->internalUrl("")."/panel.php?message=".md5(sha1("open")));
        }
        else {
            $db->redirectMethod($db->internalUrl("")."/panel.php?message=".md5(sha1("err_open")));
        }
    }
    if (isset($_GET['close'])) {
        $message_id = $db->realEscapeHtml($_GET['close']);$query = "UPDATE `Messages` SET `message_status_id` = ? WHERE `message_id` = ?";
        $p = 4;
        if ($_SESSION['roll_id'] == 3) {
            $p = 5;
        }
        $params = [$p,$message_id];
        $result = $db->curdMethod($query,$params);
        if ($result) {
            $db->redirectMethod($db->internalUrl("")."/panel.php?message=".md5(sha1("close")));
        }
        else {
            $db->redirectMethod($db->internalUrl("")."/panel.php?message=".md5(sha1("err_close")));
        }
    }
}
else {
    $db->redirectMethod($db->internalUrl("")."/panel.php");
}