<!-- 最新文章管理 -->
<form action="./api/news.php" method="post">
<table class="ct" style="width:80%;margin:auto">
    <tr>
        <th width="10%">編號</th>
        <th width="70%">標題</th>
        <th width="10%">顯示</th>
        <th width="10%">刪除</th>
    </tr>
    <?php
    // 分頁
    $all=$News->math('count','id');
    $div=3;
    $pages=ceil($all/$div);
    $now=$_GET['p']??1;
    $start=($now-1)*$div;
    $rows = $News->all(" limit $start ,$div");

    // 文章內容
    foreach ($rows as $key => $row) {
    ?>
        <tr>
            <td><?= $key + 1; ?></td>
            <td><?= $row['title']; ?></td>
            <td><input type="checkbox" name="sh[]" value="<?= $row['id']; ?>" <?= ($row['sh'] == 1) ? 'checked' : ''; ?>></td>
            <td><input type="checkbox" name="del[]" value="<?= $row['id']; ?>"></td>

        </tr>
    <?php
    }
    ?>
</table>
<div class="ct">
    <!-- 顯示分頁按鈕 -->
    <?php

        if(($now-1)>0){ //上一頁的符號『<』
            $prev=$now-1;
            echo "<a href='?do=news&p=$prev'>";
            echo " < ";
            echo "</a>";
        }

        for($i=1;$i<=$pages;$i++){ //分頁中間的數字 『1 2 3』
            $fontsize=($now==$i)?'24px':'16px';
            echo "<a href='?do=news&p={$i}' style='font-size:$fontsize'> ";
            echo $i;
            echo " </a>";
        }

        if(($now+1)<=$pages){ //下一頁的符號『>』
            $next=$now+1;
            echo "<a href='?do=news&p=$next'>";
            echo " > ";
            echo "</a>";
        }

    ?>
</div>
<div class="ct"><input type="submit" value="確定修改"></div>

</form>
