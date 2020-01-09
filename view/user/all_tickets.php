<?php
$success = "";
$error = "";
if (isset($_GET['response'])) {
    if ($_GET['response'] === md5(sha1("success"))) {
        $success = "پیام و پاسخ های شما با موفقیت حذف شد.";
    }
    elseif ($_GET['response'] === md5(sha1("error"))) {
        $error = "مشکلی در حذف پیام به وجود آمد.";
    }
    else {
        $error = "شما مجاز به حذف پیام از طریق دستکاری url نمی باشید.";
    }
}
if ($success !== "" || $error !=="" ) {
    ?>
    <h4><span class="text-success"><?php echo $success?></span></h4>
    <h4><span class="text-danger"><?php echo $error; ?></span></h4><hr/>
<?php
}
?>
<table class="table table-hover table-bordered">
    <thead>
    <tr>
        <th>#</th>
        <th>عنوان تیکت</th>
        <th>اولویت</th>
        <th>بروزرسانی در</th>
        <th>دپارتمان</th>
        <th>وضعیت تیکت</th>
        <th>بستن تیکت</th>
        <th>مشاهده</th>
        <th>حذف</th>

    </tr>
    </thead>
    <tbody>
    <?php
    $counter = 1;
        foreach ($messages as $message)
        {
            if ($_SESSION['user_id'] === $message['user_id']) {
            ?>
                <tr class="text-center">
                    <td><?php echo $counter++; ?></td>
                    <td><?php echo $message['message_title']; ?></td>
                    <td><?php echo $message['priority_description']?></td>
                    <td><?php echo $message['timestamp']; ?></td>
                    <td><?php echo $message['unit_name']; ?></td>
                    <td><?php echo $message['message_status_description']; ?></td>
                    <td>
                        <?php
                        if ($message['message_status_id'] == 4 || $message['message_status_id'] == 5 || $message['message_status_id'] == 6) {
                            if ($message['message_status_id'] == 6) {
                                ?>
                                <a href="?open=<?php echo $message['message_id']; ?>" class="disabled"><span class="glyphicon glyphicon-ban-circle"></span></a>
                                <?php
                            }
                            else {
                                ?>
                                <a href="?open=<?php echo $message['message_id']; ?>"><span class="glyphicon glyphicon-ban-circle"></span> </a>
                                <?php
                            }
                        }
                        else {
                            ?>
                            <a href="?close=<?php echo $message['message_id']; ?>"><span class="glyphicon glyphicon-ok"></span> </a>
                            <?php
                        }
                        ?>
                    </td>
                    <td><a href="?view=<?php echo $message['message_id']?>"><span class="glyphicon glyphicon-eye-open"></span></a> </td>
                    <td><a href="?delete=<?php echo $message['message_id']?>"> <span class="glyphicon glyphicon-remove"></span></a></td>

                </tr>
                <?php
            }
        }

    ?>

    </tbody>
</table>