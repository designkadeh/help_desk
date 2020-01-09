<!-- Register area -->
<div class="well register-box">
    <form action="Register.php" method="post" id="register-form">
        <legend class="text-center">ثبت نام</legend>
        <div class="form-group">
            <label for="username">نام کاربری</label>
            <input name="username" id="usernamereg" placeholder="نام کاربری" type="text" class="form-control" />
        </div>
        <div class="form-group">
            <label for="password">رمز عبور</label>
            <input name="password" id="passwordreg" placeholder="رمز عبور" type="password" class="form-control" />
        </div>
        <div class="form-group">
            <label for="name">نام</label>
            <input name="name" id="name" placeholder="نام" type="text" class="form-control" />
        </div>
        <div class="form-group">
            <label for="family">نام خانوادگی</label>
            <input name="family" id="family" placeholder="نام خانوادگی" type="text" class="form-control" />
        </div>
        <div class="form-group">
            <label for="phone">تلفن</label>
            <input name="phone" id="phone" placeholder="تلفن" type="tel" class="form-control" />
        </div>
        <div class="form-group">
            <label for="address">آدرس</label>
            <textarea rows="5" name="address" id="address" class="form-control" placeholder="آدرس"></textarea>
        </div>
        <div class="form-group">
            <label for="email">ایمیل</label>
            <input name="email" id="email" placeholder="ایمیل" type="email" class="form-control" />
        </div>
        <div class="form-group text-center">
            <input name="register" type="submit"  class="btn btn-success btn-register-submit" value="ثبت نام" />
            <button class="btn btn-danger btn-cancel-action">انصراف</button>
        </div>
    </form>
</div>