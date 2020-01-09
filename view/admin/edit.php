<?php
$sel = $db->getRows('unit_name','Units','unit_id',$_GET['edit_unit']);
?>
<h4>ویرایش واحد</h4><hr/>
<form action="" method="post">
    <input type="hidden" name="unit_id" value="<?php echo $_GET['edit_unit']?>">
    <input required name="unit_name" value="<?php echo $sel[0]['unit_name']?>" class="form-control"><br/>
    <input type="submit" name="edit_unit" value="ویرایش واحد" class="btn btn-primary">
</form>
<?php
if ($_SERVER['REQUEST_METHOD'] === "POST") {
    if (isset($_POST['edit_unit'])) {
        $unit_id = $db->realEscapeHtml($_POST['unit_id']);
        $unit_name = $db->realEscapeHtml($_POST['unit_name']);
        if ($unit_id == "" && $unit_name == "") {
            $db->redirectMethod($db->internalUrl("")."/panel.php?edit_response=".sha1(md5("free")));
        }
        else {
            $query = "UPDATE `Units` SET `unit_name` = ? WHERE `unit_id` = ?";
            $params = [$unit_name,$unit_id];
            $result = $db->curdMethod($query,$params);
            if ($result) {
                $db->redirectMethod($db->internalUrl("")."/panel.php?edit_response=".sha1(md5("edit_success")));
            }
            else {
                $db->redirectMethod($db->internalUrl("")."/panel.php?edit_response=".sha1(md5("edit_error")));
            }
        }
    }
}