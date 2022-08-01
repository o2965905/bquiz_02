<style>
    .type{
        cursor: pointer;
        color: blue;
        margin: 1rem 0;
        max-width: max-content;
    }
    .type:hover{
        /* text-decoration: underline; */
        border-bottom: 1px solid blue;
    }
</style>
<div>目前位置 : 首頁 > 分類網誌 > <span id="header">健康新知</span></div>
<div style="display:flex;">
    <fieldset style="width:20%">
        <legend>分類網誌</legend>
        <div class="type">健康新知</div>
        <div class="type">菸害防制</div>
        <div class="type">癌症防治</div>
        <div class="type">慢性病防治</div>
    </fieldset>
    <fieldset style="width:75%">
        <legend>文章列表</legend>
        <div id='content'></div>
    </fieldset>
</div>


<script>
    
    getList('健康新知');

    $(".type").on("click",function(){
        let type=$(this).text() //抓到標題的文字
        // console.log(type)
        $("#header").text(type) //id=header ,文字替換成點選到的標題文字
        getList(type); //拿到列表內容
    })

    function getList(type){ //拿到列表參數
        $.get("./api/get_list.php",{type},(list)=>{
            $("#content").html(list)
        })
    }

    function getNews(id){
        $.get("./api/get_news.php",{id},(news)=>{
            $("#content").html(news)
        })
    }
</script>