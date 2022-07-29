<!-- 帳號管理 -->
<fieldset>
    <legend>帳號管理</legend>
    <table>
        <tr>
            <td class="clo">帳號</td>
            <td class="clo">密碼</td>
            <td class="clo">刪除</td>
        </tr>
        <tbody id="users">

        </tbody>
    </table>
    <div class="ct">
        <button onclick="del()">確定刪除</button>
        <button onclick="$('table input').prop('checked',false)">清空選取</button>
    </div>
    <!-- 新增會員 -->
    <h1>新增會員</h1>
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
    getUsers();

    function reg() {
        let user = {
            acc: $("#acc").val(),
            pw: $("#pw").val(),
            pw2: $("#pw2").val(),
            email: $("#email").val()
        }

        //1.先檢查欄位是否沒有輸入資料
        if (user.acc == '' || user.pw == '' || user.pw2 == '' || user.email == '') {
            alert("不可空白")
        } else if (user.pw != user.pw2) { //2.密碼跟再次確認密碼是否一致
            alert("密碼錯誤")
        } else { //3.帳號是否重複註冊
            $.get("./api/chk_acc.php", {acc: user.acc}, (res) => {

                if (parseInt(res) == 1) {
                    alert("帳號重複")
                } else {
                    $.post("./api/reg.php", user, (res) => {

                        getUsers();
                    })
                }
            })
        }
    }

    function getUsers() {

        $.get("./api/users.php", (users) => {
            $("#users").html(users)
        })

    }

    function del() {
        let ids = new Array();

        $("table input[type='checkbox']:checked").each((idx, box) => {
            ids.push($(box).val())
        })

        // console.log(ids); //確認是否有抓到checkbox

        $.post("./api/del_user.php", {del: ids}, () => {
            getUsers();
        })
    }
</script>