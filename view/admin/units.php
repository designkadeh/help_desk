<?php
$sel_units = $db->getRows('*','Units',1,1);
$counter = 1;
require_once "unit_response.php";
?>

<a class="btn btn-primary" data-toggle="modal" data-target="#addUnit">افزودن واحد</a><br/>
<h4><span class="text-success"><?php echo $success; ?></span></h4>
<h4><span class="text-danger"><?php echo $error; ?></span></h4>
<div class="modal fade" id="addUnit" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close pull-left" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">افزودن واحد</h4>
            </div>
            <div class="modal-body">
                <form action="<?php echo $db->internalUrl("")?>/view/admin/add_user.php" method="post">
                    <input required name="unit_name" placeholder="نام واحد" class="form-control"><br/>
                    <br/>
                    <input type="submit" class="btn btn-primary btn-block" name="add_unit" value="ثبت واحد">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="pull-left btn btn-default" data-dismiss="modal">بستن</button>
            </div>
        </div>

    </div>
</div>
<br/><br/>
<table class="table table-bordered table-responsive">
    <thead>
    <tr>
        <th>#</th>
        <th>نام واحد</th>
        <th>ویرایش</th>
        <th>حذف</th>
    </tr>
    </thead>
    <tbody>
    <?php
    foreach ($sel_units as $sel_unit) {
        ?>
        <tr class="text-center">
            <td><?php echo $counter++; ?></td>
            <td><?php echo $sel_unit['unit_name']?></td>
            <td><a href="?edit_unit=<?php echo $sel_unit['unit_id']?>"><span class="glyphicon glyphicon-pencil"></span></a> </td>
            <td><a href="?remove_unit=<?php echo $sel_unit['unit_id']?>" ><span class="glyphicon glyphicon-remove"></span></a></td>
        </tr>
    <?php
    }
    ?>
    </tbody>
</table>