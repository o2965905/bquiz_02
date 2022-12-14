<!-- 註冊會員 -->
<fieldset>
    <legend>會員註冊</legend>
    <div style="color:red">*請設定您要註冊的帳號及密碼 ( 最長12個字元 ) </div>
    <table>
        <tr>
            <td class="clo">Step1:登入帳號</td>
            <td><input type="text" name="acc" id="acc"></td>
        </tr>
        <tr>
            <td class="clo">Step2:登入密碼</td>
            <td><input type="password" name="pw" id="pw"></td>
        </tr>
        <tr>
            <td class="clo">Step3:再次確認密碼</td>
            <td><input type="password" name="pw2" id="pw2"></td>
        </tr>
        <tr>
            <td class="clo">Step4:信箱(忘記密碼時使用)</td>
            <td><input type="text" name="email" id="email"></td>
        </tr>
        <tr>
            <td>
                <button onclick="reg()">註冊</button>
                <button onclick="$('table input').val('')">清除</button>
            </td>
            <td></td>
        </tr>
    </table>
</fieldset>

<script>
    function reg() {
        let user = {
            acc: $("#acc").val(),
            pw: $("#pw").val(),
            pw2: $("#pw2").val(),
            email: $("#email").val()
        }

        //1.先檢查欄位是否沒有輸入資料
        if(user.acc=='' || user.pw=='' || user.pw2=='' || user.email==''){
            alert("不可空白")
        }else if(user.pw!=user.pw2){ //2.密碼跟再次確認密碼是否一致
            alert("密碼錯誤")
        }else{ //3.帳號是否重複註冊
            $.get("./api/chk_acc.php",{acc:user.acc},(res)=>{
                console.log(res)
                if(parseInt(res)==1){
                    alert("帳號重複")
                }else{
                    $.post("./api/reg.php",user,(res)=>{
                        // console.log(res)
                        alert("註冊完成，歡迎加入")
                        location.href="?do=login"
                    })
                }
            })
        }

        // 補充: AJAX裡面 $.get() 和 $.post 差異
        // $.get() => 取得(獲取)資料
        // $.post() => 新增一筆資料
    }
</script>