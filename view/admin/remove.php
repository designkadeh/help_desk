<h4>آیا از حذف این کاربر اطمینان دارید ؟</h4><hr/>
<ul class="list-inline">
    <li><a href="<?php echo $_SERVER['REQUEST_URI']?>&response=<?php echo md5(sha1('delete'))?>" class="btn btn-danger">بله</a></li>
    <li><a href="<?php echo $db->internalUrl("")?>/panel.php?users" class="btn btn-success">خیر</a></li>
</ul>
<?php
if (isset($_GET['response'])) {
    if ($_GET['response'] === md5(sha1('delete'))) {
        $query = "DELETE FROM `Users` WHERE `user_id` = ? ";
        $param = $_GET['remove'];
        $params = [$param];
        $del = $db->curdMethod($query,$params);
        if ($del) {
            $db->redirectMethod($db->internalUrl("")."/panel.php?sremove=".md5(sha1("sremove")));
        }
        else {
            $db->redirectMethod($db->internalUrl("")."/panel.php?eremove=".md5(sha1("eremove")));
        }
    }
}