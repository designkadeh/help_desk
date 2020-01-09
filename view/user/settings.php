<?php
$error = "";
$success = "";
$disable = "";
$dis = "";

if (isset($_GET['settings'])) {
    switch ($_GET['settings']) {
        case md5(sha1("free")):
            $error = "لطفا تمام زمینه ها را پر کنید";
            break;
        case md5(sha1("success")):
            $success = "اطلاعات شما با موفقیت بروز شد";
            break;
        case md5(sha1("error")):
            $error = "مشکلی در بروزرسانی اطلاعات پیش آمده است لطفا مجددا سعی کنید.";
            break;
        case md5(sha1('change')):
        case $_GET['settings'] !== $user[0]['user_id']:
            $disable = "disabled";
            $dis = md5(sha1(time().sha1(time())));
            $dis = "<input type='hidden' name='dis' value='$dis'>";
            $error = "شما مجاز به بروزرسانی از طریق دستکاری url نمی باشید.";
            break;
    }
}
?>

<h4><span class="text-danger"><?php echo $error; ?></span> </h4>
<h4><span class="text-success"><?php echo $success; ?></span> </h4>
<form action="<?php echo $db->internalUrl("") ?>/view/user/update.php" method="post">
    <label for="name">نام</label>
    <input class="form-control" type="text" name="name" value="<?php echo $user[0]['name']; ?>" placeholder="نام شما" <?php echo $disable; ?>>
    <br/>
    <label for="family">نام خانوادگی</label>
    <input class="form-control" type="text" name="family" value="<?php echo $user[0]['family']?>" placeholder="نام خانوادگی" <?php echo $disable; ?>>
    <br/>
    <label for="email">ایمیل</label>
    <input class="form-control" type="text" name="email" value="<?php echo $user[0]['email']?>" placeholder="ایمیل" <?php echo $disable; ?>>
    <br/>
    <label for="phone">تلفن</label>
    <input class="form-control" type="text" name="phone" value="<?php echo $user[0]['phone']?>" placeholder="تلفن" <?php echo $disable; ?>>
    <br/>
    <label for="address">آدرس</label>
    <textarea rows="10" name="address" class="form-control" placeholder="آدرس" <?php echo $disable; ?>><?php echo $user[0]['address']?></textarea>
    <?php echo $dis; ?>
    <br/>
    <input type="submit" name="update" class="btn btn-primary" value="بروزرسانی" <?php echo $disable; ?>>
</form>