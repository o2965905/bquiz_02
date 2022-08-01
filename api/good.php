<!-- 紀錄按讚功能 -->
<?php
include_once "../base.php";
$type=$_POST['type'];
$id=$_POST['id'];

$news=$News->find($id);
switch($type){
    case '讚':
        $news['good']++;
        $Log->save(['news'=>$id,'user'=>$_SESSION['user']]); //寫入log資料表裡
    break;
    case '收回讚':
        $news['good']--;
        $Log->del(['news'=>$id,'user'=>$_SESSION['user']]); //從log資料表裡刪除
    break;
}

$News->save($news);

?>