<?php
session_start();
require_once "../../Database.php";
$db = new Database();

if ($_SERVER['REQUEST_METHOD'] === "POST")
{
    if (isset($_POST['reply'])) {
        $reply = $db->realEscapeHtml($_POST['reply_message']);
        $url = $db->realEscapeHtml($_POST['url']);
        $time = date('Y-m-d H:m:s');
        $unit_id = $db->realEscapeHtml($_POST['unit_id']);
        $message_id = $db->realEscapeHtml($_POST['message_id']);
        $disable = $db->realEscapeHtml($_POST['dis']);
        if ($reply !==  "") {
            if (md5(sha1($message_id)) === $disable) {
                $db->redirectMethod($db->internalUrl("")."/panel.php".$url."&response=".sha1(md5("error")));
            }
            else {
                $query = "INSERT INTO `Reply_Messages`(`reply_id`, `user_id`, `unit_id`, `message_id`, `message_status_id`, `timestamp`, `message_reply`) VALUES (?,?,?,?,?,?,?)";
                $params = [NULL,$_SESSION['user_id'],$unit_id,$message_id,1,$time,$reply];
                $insert = $db->curdMethod($query,$params);
                if ($insert) {
                    if ($_SESSION['roll_id'] == 1 || $_SESSION['roll_id'] == 2) {
                        $reply_id = $db->getRows('MAX(reply_id)','Reply_Messages','message_id',$message_id);
                        $reply_id = $reply_id[0]['MAX(reply_id)'];
                        $q = "UPDATE `Messages` SET `message_status_id` = ? , `reply_id`= ? WHERE `message_id` = ?";
                        $p = [3,$message_id,$reply_id];
                        $db->curdMethod($q,$p);
                    }
                    else {
                        $q = "UPDATE `Messages` SET `message_status_id` = ? WHERE `message_id` = ?";
                        $p = [1,$message_id];
                        $db->curdMethod($q,$p);
                    }
                    $db->redirectMethod($db->internalUrl("")."/panel.php".$url."&response=".md5(sha1("success")));

                }
            }

        }
        else {
            $db->redirectMethod($db->internalUrl("")."/panel.php".$url."&response=".md5(sha1("free")));
        }

    }
}