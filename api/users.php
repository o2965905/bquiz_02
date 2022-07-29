<!-- 帳號管理功能 -->

<?php
include_once "../base.php";

$users = $User->all();
foreach ($users as $user) {
    if ($user['acc'] !== 'admin') { //撈出管理者'admin'帳號以外的使用者資訊
        echo "<tr>";
        echo "<td>{$user['acc']}</td>";
        echo "<td>" . str_repeat("*", strlen($user['pw'])) . "</td>";
        echo "<td>";
        echo "<input type='checkbox' name='del[]' value='{$user['id']}'>";
        echo "</td>";
        echo "</tr>";
    }
}




?>