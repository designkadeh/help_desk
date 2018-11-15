<script type="text/javascript">
    let title_el = document.querySelector("title");

    if(title_el)
    title_el.innerHTML = "پنل کاربری";
</script>
<div class="container-fluid">
    <div class="row">
<?php
$user = $db->getRows('*','Users','user_id',$_SESSION['user_id']);
$admin_support = $db->getRows('*','Messages','unit_id', $_SESSION['unit_id']);
$messages = $db->multipleJoinMethod('*','Messages','Units','Messages.unit_id','Units.unit_id','Message_Status','Messages.message_status_id','Message_Status.message_status_id','Priority','Messages.priority_id','Priority.priority_id');

?>
        <div class="col-md-9">
            <div class="panel panel-default">
                <?php require_once "routing.php"; ?>
            </div>
        </div>

            <div class="col-md-3">
                <div class="panel panel-default">
                    <?php
                        foreach ($user as $users) {

                    ?>
                            <h4><span class="glyphicon glyphicon-user"></span><span class="text-danger"><?php echo $users['name']." ".$users['family']; ?></span>&nbsp;  به پنل کاربری خود خوش آمدید</h4><hr/>
                    <?php } ?>
                    <h5><span class="glyphicon glyphicon-home"></span><a href="<?php echo $db->internalUrl(""); ?>/panel.php">صفحه اصلی</a></h5><hr/>
                    <?php
                    if ($user[0]['roll_id'] == 1) {
                        ?>
                        <h5><span class="glyphicon glyphicon-th-list"></span><a href="<?php echo $db->internalUrl(""); ?>/panel.php?all_tickets">همه تیکت ها</a> </h5><hr/>
                        <h5><span class="glyphicon glyphicon-th"></span><a href="<?php echo $db->internalUrl(""); ?>/panel.php?units">واحدها</a> </h5><hr/>
                        <h5><span class="glyphicon glyphicon-user"></span><a href="<?php echo $db->internalUrl(""); ?>/panel.php?users">کاربران</a> </h5><hr/>
                    <?php
                    }
                    elseif ($user[0]['roll_id'] == 2) {
                        ?>
                        <h5><span class="glyphicon glyphicon-user"></span><a href="<?php echo $db->internalUrl(""); ?>/panel.php?users">کاربران</a> </h5><hr/>
                        <?php
                    }
                    else {
                        ?>
                        <h5><span class="glyphicon glyphicon-plus"></span><a href="<?php echo $db->internalUrl(""); ?>/panel.php?add_ticket">ایجاد تیکت جدید</a> </h5><hr/>
                    <?php
                    }
                    ?>

                    <h5><span class="glyphicon glyphicon-cog"></span><a href="<?php echo $db->internalUrl(""); ?>/panel.php?settings=<?php echo $_SESSION['user_id']?>">تنظیمات</a> </h5><hr/>
                    <h5><span class="glyphicon glyphicon-lock"></span><a href="<?php echo $db->internalUrl(""); ?>/panel.php?password=<?php echo sha1($_SESSION['user_id'])?>">تغییر رمز عبور</a></h5><hr/>
                    <h5><span class="glyphicon glyphicon-off"></span><a href="<?php echo $db->internalUrl("")?>/panel.php?logout">خروج از بخش کاربری</a></h5>
                </div>
            </div>

    </div>
</div>