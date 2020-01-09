<h4>آیا می خواهید از بخش کاربری خود خارج شوید ؟</h4><hr/>
<ul class="list-inline">
    <li><a href="<?php echo $_SERVER["REQUEST_URI"]?>=true" class="btn btn-danger">بله</a></li>
    <li><a href="<?php echo $db->internalUrl("")?>/panel.php" class="btn btn-success">خیر</a></li>
</ul>
<?php
if (isset($_GET['logout']) && $_GET['logout'] === "true") {
    $session = ['id','username','user_id','roll_id','user_status_id'];
    $db->logout($session);
}