<?php
require_once "user_response.php";
?>
<h4><span class="text-success"><?php echo $success; ?></span> </h4>
<h4><span class="text-danger"><?php echo $error; ?></span> </h4>
<table class="table table-hover table-bordered">
    <thead>
    <tr>
        <th>#</th>
        <th>عنوان تیکت</th>
        <th>اولویت</th>
        <th>بروزرسانی در</th>
        <th>دپارتمان</th>
        <th>وضعیت تیکت</th>
        <th>بستن / باز کردن تیکت</th>
        <th>مسدود / آزاد</th>
        <th>مشاهده</th>
        <th>حذف</th>

    </tr>
    </thead>
    <tbody>
    <?php
    $counter = 1;
        foreach ($messages as $message)
        {
            if ($_SESSION['unit_id'] === $message['unit_id']) {
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
                    <td>
                        <?php
                        if ($message['message_status_id'] == 6) {
                            $dis = "disabled";
                            ?>
                            <a href="?unblock_message=<?php echo $message['message_id']; ?>"><span class="glyphicon glyphicon-ban-circle"></span> </a>
                            <?php
                        }
                        else {
                            ?>
                            <a href="?block_message=<?php echo $message['message_id']; ?>"><span class="glyphicon glyphicon-ok"></span> </a>
                            <?php
                        }
                        ?>
                    </td>
                    <td><a href="?view=<?php echo $message['message_id']?>" class="<?php if ($message['message_status_id'] == 6){echo $dis;} ?>"><span class="glyphicon glyphicon-eye-open"></span></a> </td>
                    <td><a href="?delete=<?php echo $message['message_id']?>" class="<?php if ($message['message_status_id'] == 6){echo $dis;} ?>"> <span class="glyphicon glyphicon-remove"></span></a></td>
                </tr>
                <?php
            }
        }

    ?>

    </tbody>
</table>