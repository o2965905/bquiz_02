<!-- 取得'前台_文章內容'功能 -->
<?php
include_once "../base.php";

// $id=$_GET['id'];
// $news=$News->find($id);
// echo nl2br($news['text']); //nl2br = 文字段行

/*------------------------------------ */
//簡短版,把以上程式縮減成一行
echo $News->find($_GET['id'])['text'];
?>