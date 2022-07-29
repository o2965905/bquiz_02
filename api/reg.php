<?php
include_once "../base.php";

// dd($_POST); //確認有接收到資料

unset($_POST['pw2']);
$User->save($_POST);

?>