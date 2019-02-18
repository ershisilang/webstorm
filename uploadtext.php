<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>f</title>


    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script
        src="https://code.jquery.com/jquery-3.3.1.js"
        integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>


    <style type="text/css">
        .nav{font-size:20px;
            color: #0084ff;
        }

        .container{

            padding-top:2em;
            padding-left:3em;

        }


        .form-group{
            width:25em;
        }


        #time{
            width:25em;
        }


    </style>

</head>
<body>



<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">爱提醒管理后台</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="uploadtext.php">发送提醒 <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="recordlist.php">提醒记录</a>
            </li>

            <li class="nav-item ">
                <a class="nav-link" href="my.php">我的</a>
            </li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    控制台
                </a>
                <div class="dropdown-menu  dropdown-menu-right" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" id="my" href="#">退出账号</a>
                </div>
            </li>
        </ul>

    </div>
</nav>


<script src="laydate/laydate.js"></script>
<script>
    laydate.render({
        elem: '#time'
        ,type: 'datetime'
    });
</script>


<div class="container">


    <div class="form-group">
        <label for="tel">电话号码</label>
        <input type="text" class="form-control" id="tel" name="tel"
               placeholder="请输入接收人的电话号码,必填">
    </div>

    <div class="form-group">
        <label for="content">通知内容</label>
        <input type="text" class="form-control" id="content" name="content"
               placeholder="请输入电话提醒的内容（系统自动将文字转为语音）">
    </div>


    <div class="form-group">
        <label for="name">发送时间</label>
        <input type="text" id="time" name="time" placeholder="请选择日期">
    </div>

    <div style="color:#F00" id="uploadtip">发的发的发</div>



    <button type="button" class="btn btn-default" id="uploadbutton">提交</button>


</div>

<!-- 前端校验  -->
<script>

    document.getElementById("uploadtip").innerText == '';
    $('#uploadbutton').click(function(){

        document.getElementById("uploadtip").innerText == '';


        var myreg =/^(((13[0-9]{1})|(15[0-9]{1})|(18[0-9]{1}))+\d{8})$/;//校验手机



        var tel = $("#tel").val();
        var content = $("#content").val();
        var time = $("#time").val();

        var reg = new RegExp("^[A-Za-z0-9\u4e00-\u9fa5]+$");
        //获取输入框中的值
        var content= document.getElementById("content").value.trim();
        //判断输入框中有内容


        var fm ="tel=" + tel + "&content=" + content + "&time=" + time;



        if(tel == "" ||tel == null){
            $("#tel").focus;
            $("#uploadtip").html("请输入手机号码")

        }


        else if(!myreg.test(tel)){
            $("#tel").focus;
            $("#uploadtip").html("请输入11位手机号")
        }

        else if(content == "" ||content == null){
            $("#content").focus;
            $("#uploadtip").html("请输入通知内容")
        }


        else  if (!reg.test(content))
        {
            $("#content").focus;
            $("#uploadtip").html("通知内容仅能包含汉字,数字或者英文")
        }





        else if(time == "" ||time== null){
            $("#time").focus;
            $("#uploadtip").html("请选择发送时间")
        }


        else{
            $.ajax(
                {
                    method: "post",
                    url: 'uploadtest.php',
                    data: fm,
                    success: function (data) {
                        $("#uploadtip").html(data);
                        setTimeout(function(){
                            document.getElementById("uploadtip").innerHTML = "";
                        }, 5000);

                    }
                }
            );
        }
    });


</script>


</body>
</html>


