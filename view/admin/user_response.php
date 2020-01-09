<?php
$success = "";
$error = "";
$response = explode("=",$_SERVER['QUERY_STRING']);
if (isset($response[1])) {
    switch ($response[1]) {
        case md5(sha1("success")):
            $success = "عملیات مسدود سازی / آزاد سازی با موفقیت انجام پذیرفت.";
            break;
        case md5(sha1("error")):
            $error = "خطا در اجرای دستور";
            break;
        case md5(sha1("sremove")):
            $success = "کاربر با موفقیت حذف شد";
            break;
        case md5(sha1("eremove")):
            $error = "خطایی در حذف کاربر رخ داد.";
            break;
        case sha1(md5("success_user")):
            $success = "کاربر با موفقیت ایجاد شد.";
            break;
        case sha1(md5("error_user")):
            $error = "خطایی در ایجاد کاربر رخ داد";
            break;
        case sha1(md5("exist_user")):
            $error = "نام کاربری انتخابی شما وجود دارد.";
            break;
    }
}