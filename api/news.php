<!-- 最新文章管理功能 -->
<?php
include_once "../base.php";

if(isset($_POST['del'])){
    foreach($_POST['del'] as $id){
        $News->del($id);
    }
}

$rows=$News->all();
foreach($rows as $row){
    if(in_array($row['id'],$_POST['sh'])){
        $row['sh']=1;
    }else{
        $row['sh']=0;
    }

    $News->save($row);
}

to("../back.php?do=news");

?>