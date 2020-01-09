<?php
$success = "";
$error = "";
$response = explode("=",$_SERVER['QUERY_STRING']);
if (isset($response[1])) {
    switch ($response[1]) {
        case md5(sha1("unblock")):
            $success = "پیام با موفقیت آزاد شد";
            break;
        case md5(sha1("err_unblock")):
            $error = "خطا در آزاد سازی پیام";
            break;
        case md5(sha1("block")):
            $success = "پیام با موفقیت مسدود شد";
            break;
        case md5(sha1("err_block")):
            $error = "خطا در مسدود سازی پیام";
            break;
        case md5(sha1("open")):
            $success = "پیام با موفقیت باز شد";
            break;
        case md5(sha1("err_open")):
            $error = "خطا در باز کردن پیام";
            break;
        case md5(sha1("close")):
            $success = "پیام با موفقیت بسته شد";
            break;
        case md5(sha1("err_close")):
            $error = "خطا در بستن پیام";
            break;
    }
}