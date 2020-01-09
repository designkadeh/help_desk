<?php
$success = "";
$error = "";
$disabled = "";
$dis = "";
$message_id = explode("=",$_GET['view']);
$ticket = $db->getRows('*','Messages','message_id',$message_id[0]);
$response = $db->getRows('*','Reply_Messages','message_id',$message_id[0]);

if ($response) {
    foreach ($response as $item) {
        $unit_user = $db->getRows('*','Users','user_id',$item['user_id']);
            foreach ($unit_user as $unit_users) {
                if ($unit_users['user_id'] === $_SESSION['user_id']) {
                    ?>
                    <h4>پاسخ شما</h4><hr/>
                    <?php
                }
                else {
                    ?>
                    <h4>پاسخ به شما توسط<span class="text-danger">
                        <?php echo $unit_users['name']." ".$unit_users['family']; ?>
                    </span></h4><hr/>
                    <?php
                }
            } ?>
        <p><?php echo $item['message_reply']?></p><br/>
        <?php

    }
}

if ($ticket[0]['message_status_id'] == 4 || $ticket[0]['message_status_id'] == 5 || $ticket[0]['message_status_id'] == 6)
{
    $dis = md5(sha1($message_id[0]));
    if ($dis) {
        $disabled = "disabled";
    }
}

if (isset($_GET['response'])) {
    $response = $_GET['response'];
    if ($response === sha1(md5('error'))) {
        $error = "این تیکت بسته شده است لطفا تیکت جدیدی ایجاد نمایید.";
    }
    elseif ($response === md5(sha1("success"))) {
        $success = "پیام شما با موفقیت ثبت شد";
    }
    elseif ($response === md5(sha1("free"))) {
        $error = "لطفا پیامی بنویسید";
    }
    else {
        $error = "شما مجاز به ارسال تیکت از طریق دستکاری url نمی باشید.";
    }
}

if ($_SESSION['roll_id'] == 1 || $_SESSION['roll_id'] == 2) {
    if ($ticket[0]['message_status_id'] == 1) {
        $query = "UPDATE `Messages` SET `message_status_id` = ? WHERE `message_id` = ?";
        $params = [2,$message_id[0]];
        $db->curdMethod($query,$params);
    }
}

?>
<br/><br/><br/>
<h4><span class="text-success"><?php echo $success; ?></span></h4>
<h4><span class="text-danger"><?php echo $error; ?></span></h4>
<h4>پاسخ به پیام</h4>
    <form action="<?php echo $db->internalUrl("")?>/view/user/reply_ticket.php" method="post">
        <textarea class="form-control" rows="10" name="reply_message" <?php echo $disabled?>  ></textarea><br/>
        <input name="url" type="hidden" value="?<?php echo $_SERVER['QUERY_STRING'];?>">
        <input type="hidden" name="message_id" value="<?php echo $message_id[0]; ?>">
        <input type="hidden" name="unit_id" value="<?php echo $ticket[0]['unit_id']?>">
        <input type="hidden" name="dis" value="<?php echo $dis?>">
        <input type="submit" name="reply" value="پاسخ دهید" class="btn btn-primary" <?php echo $disabled?>>
    </form>
<br/><br/><br/>

<h1>پیام اصلی</h1><hr/>
<?php
    foreach ($ticket as $item) {
        ?>
        <h4><?php echo $item['message_title']?></h4><hr/>
        <p class="text-justify"><?php echo $item['message']?></p>
<?php
    }