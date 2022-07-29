<!-- 問卷管理功能 -->
<?php
include_once "../base.php";

if(!empty($_POST['subject'])){ //主題
    $Que->save(['text'=>$_POST['subject'],
                'subject_id'=>0,
                'count'=>0]);
    $subject_id=$Que->find(['text'=>$_POST['subject']])['id'];

    if(!empty($_POST['option'])){ //選項
        foreach($_POST['option'] as $opt){
            $Que->save(['text'=>$opt,
                        'subject_id'=>$subject_id,
                        'count'=>0]);
        }
    }
}


to("../back.php?do=que");

?>