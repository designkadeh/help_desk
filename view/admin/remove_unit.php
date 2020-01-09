<h4>آیا از حذف این واحد اطمینان دارید ؟</h4><hr/>
<ul class="list-inline">
    <li><a href="<?php echo $_SERVER['REQUEST_URI']?>&response=<?php echo md5(sha1('delete'))?>" class="btn btn-danger">بله</a></li>
    <li><a href="<?php echo $db->internalUrl("")?>/panel.php?units" class="btn btn-success">خیر</a></li>
</ul>
<?php
if (isset($_GET['response'])) {
    if ($_GET['response'] === md5(sha1('delete'))) {
        $query = "DELETE FROM `Units` WHERE `unit_id` = ? ";
        $param = $_GET['remove_unit'];
        $params = [$param];
        $del = $db->curdMethod($query,$params);
        if ($del) {
            $db->redirectMethod($db->internalUrl("")."/panel.php?unit_response=".md5(sha1("sremove")));
        }
        else {
            $db->redirectMethod($db->internalUrl("")."/panel.php?unit_response=".md5(sha1("eremove")));
        }
    }
}