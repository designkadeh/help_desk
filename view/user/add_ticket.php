<?php

$success = "";
$error = "";
$response = explode("=",$_SERVER['QUERY_STRING']);

if (isset($response[1])) {
    switch ($response[1]) {
        case md5(sha1("free")):
            $error = "پر کردن تمام زمینه ها الزامی است";
            break;
        case md5(sha1("success")):
            $success = "پیام شما با موفقیت ثبت شد!";
            break;
        case md5(sha1("error")):
            $error = "متاسفانه مشکلی در ثبت اطلاعات پیش آمد.";
            break;
    }
}

?>
<h1>تیکت خود را ایجاد کنید</h1><hr/>
<h4><span class="text-success"><?php echo $success; ?></span></h4>
<h4><span class="text-danger"><?php echo $error; ?></span></h4>
<form action="<?php echo $db->internalUrl("")?>/view/user/send.php" method="post">
    <h4>عنوان پیام شما</h4>
    <input class="form-control" type="text" name="message_title"><br/>
    <h4>واحد مربوطه</h4>
    <select class="form-control" name="unit_id">
        <option value="1">مدیریت</option>
        <option value="2">امور هاستینگ</option>
        <option value="3">امور دامنه ها</option>
        <option value="4">امور فنی</option>
    </select><br/>
    <h4>اولویت</h4>
    <select name="priority_id" class="form-control">
        <option value="1">فوری</option>
        <option value="2">متوسط</option>
        <option value="3">کم</option>
    </select><br/>
    <h4>پیام شما</h4>
    <textarea class="form-control" name="message" rows="6"></textarea><br/><br/>
    <input type="submit" name="add_ticket" value="ارسال تیکت" class="btn btn-primary">
</form>