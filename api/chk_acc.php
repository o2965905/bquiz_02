<!-- 檢驗帳號密碼 -->
<?php
include_once "../base.php";

$acc=$_POST['acc'];
//找帳號_方法2_簡短版
echo $User->math('count','id',['acc'=>$acc]);

/**
 *找帳號_方法1_判斷式版
 * $chk=$User->find(['acc'=>$acc]); 
 * if(!empty($chk)){
 *    echo 1;
 * }else{
 *    echo 0;
*  }
*/


?>