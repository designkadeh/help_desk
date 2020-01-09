<?php

require_once "user_response.php";
$admin_users = $db->multipleJoinMethod('*','Users','Units','Users.unit_id','Units.unit_id','User_Status','Users.user_status_id','User_Status.user_status_id','Rolls','Users.roll_id','Rolls.roll_id');
?>
<h4><span class="text-success"><?php echo $success?></span> </h4>
<h4><span class="text-danger"><?php echo $error?></span> </h4>
<a class="btn btn-primary" data-toggle="modal" data-target="#addUser">افزودن کاربر</a><br/><br/>
<div class="modal fade" id="addUser" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close pull-left" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">افزودن کاربر</h4>
            </div>
            <div class="modal-body">
                <form action="<?php echo $db->internalUrl("")?>/view/admin/add_user.php" method="post">
                    <input required name="name" placeholder="نام" class="form-control"><br/>
                    <input required name="family" placeholder="نام خانوادگی" class="form-control"><br/>
                    <input required name="phone" placeholder="تلفن" class="form-control"><br/>
                    <textarea required name="address" placeholder="آدرس" class="form-control" rows="7"></textarea> <br/>
                    <input required name="email" placeholder="ایمیل" class="form-control"><br/>
                    <input required name="username" placeholder="نام کاربری" class="form-control"><br/>
                    <input required type="password" name="password" placeholder="رمز عبور" class="form-control"><br/>
                    <label for="roll_id">نقش کاربری</label>
                    <?php
                    $sel_roll = $db->getRows('*','Rolls',1,1);
                    $sel_units = $db->getRows('*','Units',1,1);
                    ?>
                    <select required name="roll_id" class="form-control">
                        <option value="">لطفا انتخاب کنید</option>
                        <?php
                        foreach ($sel_roll as $sel_rolls)
                        {
                            ?>
                            <option value="<?php echo $sel_rolls['roll_id']?>"><?php echo $sel_rolls['roll_name']?></option>
                        <?php
                        }
                        ?>

                    </select><br/>
                    <label for="unit_id">واحد</label>
                    <select required name="unit_id" class="form-control">
                        <option value="">لطفا انتخاب کنید</option>
                        <?php
                        foreach ($sel_units as $sel_unit) {
                            ?>
                            <option value="<?php echo $sel_unit['unit_id']?>"><?php echo $sel_unit['unit_name']?></option>
                        <?php
                        }
                        ?>
                    </select>
                    <br/>
                    <input type="submit" class="btn btn-primary btn-block" name="add_user" value="ثبت کاربر">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="pull-left btn btn-default" data-dismiss="modal">بستن</button>
            </div>
        </div>

    </div>
</div>
<table class="table table-responsive table-bordered">
    <thead>
    <tr>
        <th>#</th>
        <th>نام</th>
        <th>نام خانوادگی</th>
        <th>تلفن</th>
        <th>ایمیل</th>
        <th>آدرس</th>
        <th>نقش کاربری</th>
        <th>واحد</th>
        <th>وضعیت کاربر</th>
        <th>مسدود / آزاد</th>
        <th>حذف</th>
    </tr>
    </thead>
    <tbody>
    <?php
    $counter = 1;
    foreach ($admin_users as $users) {
        if ($users['roll_id'] != 1) {
            ?>
            <tr class="text-center">
                <td><?php echo $counter++; ?></td>
                <td><?php echo $users['name']; ?></td>
                <td><?php echo $users['family']; ?></td>
                <td><?php echo $users['phone']; ?></td>
                <td><?php echo $users['email']; ?></td>
                <td><?php echo $users['address']; ?></td>
                <td><?php echo $users['roll_name']; ?></td>
                <td><?php echo $users['unit_name']; ?></td>
                <td><?php echo $users['user_status_description']; ?></td>
                <td>
                    <?php
                    if ($users['user_status_id'] == 1) {
                        ?>
                        <a href="?block=<?php echo $users['user_id']; ?>"><span class="glyphicon glyphicon-ok"></span> </a>
                        <?php
                    }
                    else {
                        ?>
                        <a href="?unblock=<?php echo $users['user_id']; ?>"><span class="glyphicon glyphicon-ban-circle"></span> </a>
                        <?php
                    }
                    ?>
                </td>
                <td><a href="?remove=<?php echo $users['user_id']?>"><span class="glyphicon glyphicon-remove"></span> </a> </td>
            </tr>
            <?php
        }
    }
    ?>

    </tbody>
</table>
