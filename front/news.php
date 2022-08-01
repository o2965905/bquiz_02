<!-- 前台_最新文章區 -->
<fieldset>
    <legend>目前位置 : 首頁 > 最新文章區</legend>
    <table>
        <tr>
            <td width="30%">標題</td>
            <td width="50%">內容</td>
            <td width="20%"></td>
        </tr>
        <!-- 撈出資料 -->
        <?php
        $all=$News->math('count','id',['sh'=>1]);
        $div=5;
        $pages=ceil($all/$div);
        $now=$_GET['p']??1;
        $start=($now-1)*$div;

        $rows=$News->all(['sh'=>1]," limit $start,$div");
        foreach($rows as $row){
        ?>
        <tr>
            <td><?=$row['title'];?></td>
            <td><?=mb_substr($row['text'],0,20);?>...</td>
            <td></td>
        </tr>
        <?php
        }
        ?>
    </table>
    <!-- 顯示分頁數字 -->
    <div>
        <?php
            if(($now-1)>0){ //上一頁的符號『<』
                $prev=$now-1;
                 echo "<a href='?do=news&p=$prev'>";
                echo " < ";
                echo "</a>";
            }

            for($i=1;$i<=$pages;$i++){
                $fontsize=($now==$i)?'24px':'18px';
                echo "<a href='?do=news&p={$i}' style='font-size:{$fontsize}'> $i </a>";
            }
            
            if(($now+1)<=$pages){ //下一頁的符號『>』
                $next=$now+1;
                echo "<a href='?do=news&p=$next'>";
                echo " > ";
                echo "</a>";
                }
        ?>
    </div>
</fieldset>