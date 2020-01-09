<?php
$error = "";
$success = "";
if (isset($_GET['response'])) {
    switch ($_GET['response']) {
        case md5("free"):
            $error = "تمام زمینه ها را پر کنید.";
            break;
        case md5("change"):
            $success = "رمز عبور شما بدون تغییر باقی ماند";
            break;
        case md5("password"):
            $error = "کلمه عبور شما صحیح نمی باشد.";
            break;
        case md5("match"):
            $error = "کلمه عبور جدید و تکرار آن با هم مطابقت ندارند.";
            break;
        case md5("error"):
            $error = "مشکلی در بروزرسانی پیش آمد";
            break;
        case sha1("success"):
            $success = "کلمه عبور شما با موفقیت تغییر یافت.";
            break;
    }
}
?>
<h4><span class="text-danger"><?php echo $error; ?></span></h4>
<h4><span class="text-success"><?php echo $success; ?></span></h4>
<form method="post" action="<?php echo $db->internalUrl(""); ?>/view/user/update.php" autocomplete="off">
    <label for="old_pass">رمز عبور فعلی</label>
    <input class="form-control" type="password" name="old_pass" placeholder="رمز عبور فعلی"><br/>
    <label for="new_pass">رمز عبور جدید</label>
    <input class="form-control" type="password" name="new_pass" placeholder="رمز عبور جدید"><br/>
    <label for="renew_pass">تکرار رمز عبور جدید</label>
    <input class="form-control" type="password" name="renew_pass" placeholder="تکرار رمز عبور جدید"><br/>
    <input type="submit" name="change_password" value="تغییر رمز عبور" class="btn btn-primary">
</form>