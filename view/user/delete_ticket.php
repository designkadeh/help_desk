<h4>آیا از حذف این پیام اطمینان دارید ؟</h4><hr/>
<ul class="list-inline">
    <li><a href="<?php echo $_SERVER['REQUEST_URI']?>&response=<?php echo md5(sha1('delete'))?>" class="btn btn-danger">بله</a></li>
    <li><a href="<?php echo $db->internalUrl("")?>/panel.php" class="btn btn-success">خیر</a></li>
</ul>
<?php
if (isset($_GET['response'])) {
    $message_id = explode("=",$_GET['delete']);
    if ($_GET['response'] === md5(sha1('delete'))) {
        $del = $db->curdMethod("DELETE FROM `Messages` WHERE `message_id` = '".$message_id[0]."' ");
        if ($del) {
            $db->redirectMethod($db->internalUrl("")."/panel.php?response=".md5(sha1("success")));
        }
        else {
            $db->redirectMethod($db->internalUrl("")."/panel.php?response".md5(sha1("error")));
        }
    }
}