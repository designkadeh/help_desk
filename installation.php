<?php
$version = PHP_VERSION;
?>
    <script type="text/javascript">
        let title_el = document.querySelector("title");

        if(title_el)
            title_el.innerHTML = "نصب و راه اندازی";
    </script>
<div class="container">
    <div class="panel panel-default">
        <h4>راه اندازی برنامه</h4><hr/>
        <?php
        if ($version < 7) {
            echo "<h4><span class='text-danger'>ورژن PHP خود را برای اجرای پروژه به 7 تغییر دهید.</span> </h4>";
        }
        else {
        ?>
        <form action="setup.php" method="post">
            <label for="db_name"><span class="text-danger">**  &nbsp;</span>نام دیتابیس</label>
            <input class="form-control" name="db_name">
            <span class="text-muted">** نام انتخابی شما برای دیتابیس</span><br/><br/>
            <label for="localhost"><span class="text-danger">**  &nbsp;</span>نوع ارتباط با دیتابیس</label>
            <input class="form-control" name="localhost" value="<?php echo $_SERVER['SERVER_NAME']?>">
            <span class="text-muted">** نوع ارتباط با دیتابیس به طور پیش فرض localhost</span><br/><br/>
            <label for="local_user"><span class="text-danger">**  &nbsp;</span>نام کاربری دیتابیس</label>
            <input class="form-control" name="local_user" value="root">
            <span class="text-muted">** به طور پیش فرض root</span><br/><br/>
            <label for="local_pass"><span class="text-danger">**  &nbsp;</span>رمز عبور پایگاه داده</label>
            <input class="form-control" name="local_pass" value="">
            <span class="text-muted">** به طور پیش فرض خالی</span><br/><br/>
            <label for="mysql_port"><span class="text-danger">**  &nbsp;</span>پورت اتصال به mysql</label>
            <input class="form-control" name="mysql_port" value="3306">
            <span class="text-muted">** به طور پیش فرض 3306</span><br/><br/>
            <input type="submit" class="btn btn-primary pull-left" name="install" value="راه اندازی برنامه"><br/>
        </form>
    </div>
</div>
<?php }