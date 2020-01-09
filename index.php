<?php
session_start();
require_once "Database.php";
$db_message = "";
$db = new Database();
if ($_SESSION) {
    if ($_SESSION['username']) {
        $db->redirectMethod('panel.php');
    }
}
include_once "view/header.php";
if (file_exists("installation.php")) {
    require_once "installation.php";
}
else {
    if (isset($_GET['response']) == md5("DATABASE &".sha1("TABLES successfully".md5("created!")))) {
        if (file_exists("setup.php")) {
            $set = unlink("setup.php");
            if ($set) {
                $db_message = "دیتابیس و جدول های آن با موفقیت ساخته شد و اطلاعات اولیه درون ریزی شد، نام کاربری و رمز عبور پیش فرض admin می باشد.";
                $db_message .= "<br/><br/>";
            }
        }
    }
    ?>
    <link rel="stylesheet" type="text/css" href="<?php echo $db->internalUrl("") ?>/assets/css/custom.css">
    <div class="container">
        <div class="row">
            <div class="com-md-12">
                <div class="notification login-alert">
                    لطفا نام کاربری و رمز عبور را وارد کنید !
                </div>
                <div class="notification register-alert">
                    لطفا همه موارد را پر کنید
                </div>
                <div class="notification login-err">
                    نام کاربری یا رمز عبور شما اشتباه است !
                </div>
                <div class="notification submit-err">
                    نام کاربری انتخابی شما وجود دارد !
                </div>
                <div class="notification notification-success logged-out">
                    شما با موفقیت خارج شدید
                </div>
                <div class="notification notification-success success-data">
                    اطلاعات شما با موفقیت ثبت شد
                </div>
                <div class="well welcome-text">
                    <?php if (isset($_GET['response'])) {echo $db_message;} ?>
                    سلام, برای دسترسی به برنامه
                    <button class="btn btn-default btn-login">وارد شوید</button>
                    یا
                    <button class="btn btn-default btn-register">ثبت نام کنید</button>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <?php
                include_once "view/login.php";
                include_once "view/register.php";
                ?>

            </div>
        </div>
    </div>

    <?php
}
include_once "view/footer.php";