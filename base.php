<?php
session_start();
date_default_timezone_set('Asia/Taipei');


class DB // 建立基礎屬性
{
    protected $table;
    protected $dsn='mysql:host=localhost;charset=utf8;dbname=db19';
    protected $pdo;


    function __construct($table)
    {
        $this->table=$table;
        $this->pdo=new PDO($this->dsn,'root','');
    }

    /**
     * 
     * -預計需要的功能-
     * 1.新增資料 insert()
     * 2.修改資料 update()
     * (整合功能) insert() + update() => save()
     * 3.查詢資料 all(),find()
     * 4.刪除資料 del()
     * 5.計算功能 max(),min(),sum(),count(),avg(),... => math()
     * 
     * -補充-
     * ($array) //特定欄位條件的多筆資料
     * ($array,$sql) //有欄位條件又有額外條件的多筆資料 (...where ...limit ..., ...where ...order by ...)
     * () //不帶任何參數 = 整張資料表
     * ($sql) //只有額外條件的多筆資料 (...limit...,order by ...,group by ...)
     * 
     */
     
/*----------------------------------------------------------------------------------------------------*/ 
    function all(...$arg){
        $sql="select * from $this->table ";
        if(isset($arg[0])){
            if(is_array($arg[0])){
                foreach($arg[0] as $key => $val){
                    $tmp[]="`$key`='$val'";
                }
                // $sql = $sql . "where" . join(" && ",$tmp);
                $sql .= "where" . join(" && ",$tmp);
            }else{
                // $sql = $sql . $arg[0];
                $sql .= $arg[0]; 
            }
        }

        if(isset($arg[1])){
            $sql .= $arg[1];
        }

        // echo $sql;
        return $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }
/*----------------------------------------------------------------------------------------------------*/
    function find($arg){
        $sql="select * from $this->table where";
        if(is_array($arg)){
            foreach($arg as $key => $val){
                $tmp[]="`$key`='$val'";
            }
            $sql .= join(" && ",$tmp);
        }else{
            $sql .= " `id`='$arg'";
        }

        // echo $sql;
        return $this->pdo->query($sql)->fetch(PDO::FETCH_ASSOC);
    }
/*----------------------------------------------------------------------------------------------------*/
    function save($array){
        if(isset($array['id'])){
            //更新
            foreach($array as $key => $val){
                $tmp[]="`$key`='$val'";
            }
            $sql="update $this->table set  ".join(',',$tmp)."  where `id`='{$array['id']}'";
        }else{
            //新增
            $sql="insert into $this->table (`".join("`,`",array_keys($array))."`) values('".join("','",$array)."')";
        }

        // echo $sql;
        return $this->pdo->exec($sql);
    }
/*----------------------------------------------------------------------------------------------------*/
    function del($arg){
        $sql="delete from $this->table where";
        if(is_array($arg)){
            foreach($arg as $key => $val){
                $tmp[]="`$key`='$val'";
            }
            $sql .= join(" && ",$tmp);
        }else{
            $sql .= " `id`='$arg'";
        }

        return $this->pdo->exec($sql);
    }
/*----------------------------------------------------------------------------------------------------*/
    function math($math,$col,...$arg){
        $sql="select $math($col) from $this->table ";
        if(isset($arg[0])){
            if(is_array($arg[0])){
                foreach($arg[0] as $key => $val){
                    $tmp[]="`$key`='$val'";
                }
                $sql .= $arg[0];
            }
        }

        if(isset($arg[1])){
            $sql .= $arg[1];
        }

        // echo $sql;
        return $this->pdo->query($sql)->fetchColumn();
    }
/*----------------------------------------------------------------------------------------------------*/
    function q($sql){
        return $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }
/*----------------------------------------------------------------------------------------------------*/
    function dd($array){
        echo "<pre>";
        print_r($array);
        echo "</pre>";
    }
/*----------------------------------------------------------------------------------------------------*/
    function to($url){
        header('location:'.$url);
    }
/*----------------------------------------------------------------------------------------------------*/

}

$Total=new DB('total');
// print_r($Total->find(['total'=>10]));

?>