<?php
include_once "../base.php";

// dd($_POST); //確認有接收到資料

//除了pw2(再次確認密碼欄位)的資料,其他欄位的資料都要寫入user資料表
unset($_POST['pw2']); 
$User->save($_POST);

?>