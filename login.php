
<!-- Login area --><div class="well login-box">
    <form action="login.php" method="post" id="login-form">
        <legend>ورود</legend>
        <div class="form-group">
            <label for="username">نام کاربری</label>
            <input name="username" id="username" placeholder="نام کاربری" type="text" class="form-control" />
        </div>
        <div class="form-group">
            <label for="password">رمز عبور</label>
            <input name="password" id="password" value='' placeholder="رمز عبور" type="password" class="form-control" />
        </div>
        <div class="form-group text-center">
            <input name="login" type="submit" class="btn btn-success btn-login-submit" value="ورود" />
            <button class="btn btn-danger btn-cancel-action">انصراف</button>
        </div>
    </form>
</div>
<div class="logged-in well">
    <h1>شما وارد شدید !
        <div class="pull-left">
            <a href="<?php echo $db->internalUrl("/view")?>/panel.php" class="btn btn-info"><span class="glyphicon glyphicon-dashboard logout"></span> ورود به پنل کاربری</a>
            <button class="btn-logout btn btn-danger"><span class="glyphicon glyphicon-off logout"></span>خروج</button>
        </div>
    </h1>
</div>