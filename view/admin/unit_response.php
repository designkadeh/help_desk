<?php
$success = "";
$error = "";
$response = explode("=",$_SERVER['QUERY_STRING']);
if (isset($response[1])) {
    switch ($response[1]) {
        case md5(sha1("add_unit")):
            $success = "واحد با موفقیت ثبت شد";
            break;
        case md5(sha1("err_add_unit")):
            $error = "خطایی در ثبت واحد به وجود آمد";
            break;
        case md5(sha1("exist_add_unit")):
            $error = "نام واحد وجود دارد";
            break;
        case md5(sha1("sremove")):
            $success = "واحد با موفقیت حذف شد";
            break;
        case md5(sha1("eremove")):
            $error = "مشکلی در حذف واحد به وجود آمد.";
            break;
        case sha1(md5("edit_success")):
            $success = "واحد با موفقیت ویرایش شد.";
            break;
        case sha1(md5("edit_error")):
            $error = "مشکلی در ویرایش واحد به وجود آمد";
            break;
        case sha1(md5("free")):
            $error = "لطفا نام واحد را پر کنید";
            break;
    }
}