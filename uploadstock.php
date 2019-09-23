<?php



?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Document</title>
    <script>
        var _hmt = _hmt || [];
        (function() {
            var hm = document.createElement("script");
            hm.src = "https://hm.baidu.com/hm.js?24878ba02373ef0bb0a828acf30bb257";
            var s = document.getElementsByTagName("script")[0];
            s.parentNode.insertBefore(hm, s);
        })();
    </script>
    <script  src="https://code.jquery.com/jquery-3.3.1.js"            integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="            crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">



    <style type="text/css">
        .nav{font-size:20px;
            color: #0084ff;
        }

        .container{

            padding-top:2em;
            padding-left:3em;

        }




        #time{
            width:25em;
        }

        .modal-body ul {
            list-style:none;margin:0; padding:0; position:absolute;background-color:#f5f5f5;width:11em;
        }

        li:hover {
            background:#009dff;
            color:white;
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
            <li class="nav-item ">
                <a class="nav-link" href="uploadtext.php">事件提醒<span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="uploadstock.php">股票提醒</a>
            </li>
            <li class="nav-item active">
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
                    <a class="dropdown-item" id="my"   href="session.php">退出</a>
                </div>
            </li>
        </ul>

    </div>
</nav>


<div class="container">



    <button class="btn btn-primary " data-toggle="modal" data-target="#setstock">新增提醒</button>

</div>

<div id="setstock" class="modal fade" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <button class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-title">
                <h4 class="text-center">添加预警</h4>
            </div>

            <div class="modal-body">
                <form id="form-group" >

                    <div class="div1">
                        <input  type="text" id="keyword" name="keyword" placeholder="请输入股票名称" />
                        <div id="searchBox" style="display: none"></div>
                    </div>


            <div class="form-group" ">
                        <input type="checkbox" name="upstock"  checked="checked" />
                        <label for="reg_tel">上涨到</label>
                        <input class="form-control" type="text" id="reg_tel" name="reg_tel" placeholder="单位元">
                    </div>
                    <div class="form-group">
                        <input type="checkbox" name="downstock"  checked="checked" />
                        <label for="reg_pas1">下跌到</label>
                        <input class="form-control" type="password"   id="reg_pas1" name="reg_pas1" placeholder="单位元">
                    </div>

                    <div style="color:#F00" id="tip"></div>
                    <div class="text-right">
                        <button class="btn btn-primary"  id="sign_button"  name="sign_button" type="button">提交</button>
                        <button class="btn btn-danger" data-dismiss="modal" >取消</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>


<script>
    $(document).ready(function(){
        var xhr=null;
        $('input[name="keyword"]').keyup(function() {
            if(xhr){
                xhr.abort();//如果存在ajax的请求，就放弃请求
            }
            var inputText= $.trim(this.value);
            if(inputText!=""){//检测键盘输入的内容是否为空，为空就不发出请求
                xhr=$.ajax({
                    type: 'GET',
                    url: 'setnewstock.php',
                    cache:false,//不从浏览器缓存中加载请求信息
                    data: "keyword=" + inputText,//向服务器端发送的数据
                    dataType: 'json',//服务器返回数据的类型为json
                    success: function (json) {
                        if (json.length!= 0) {//检测返回的结果是否为空
                            var lists = "<ul>";
                            $.each(json, function () {
                                lists += "<li>"+this.stocknames+"</li>";//遍历出每一条返回的数据
                            });
                            lists+="</ul>";

                            $("#searchBox").html(lists).show();//将搜索到的结果展示出来

                            $("li").click(function(){
                                $("#keyword").val($(this).text());//点击某个li就会获取当前的值
                                $("#searchBox").hide();
                            })

                        } else {
                            $("#searchBox").hide();
                        }


                    }

                });
            }else{
                $("#searchBox").hide();//没有查询结果就隐藏搜索框
            }
        })

        $('#sign_button').click(function(){

            document.getElementById("tip").innerHTML = "";
            var stockname = $("#searchBox").val();


            var reg_pas1 =$("#reg_pas1").val();
            var reg_pas2 =$("#reg_pas2").val();
            var myreg = /^(((13[0-9]{1})|(15[0-9]{1})|(18[0-9]{1}))+\d{8})$/;//校验用户名

            var reg=/^[0-9]{6,16}$|^[a-zA-Z]{6,16}$/;//校验密码
            var regdata = "reg_tel=" + reg_tel + "&reg_pas1=" + reg_pas1 + "&reg_pas2=" + reg_pas2;

            if(reg_tel == "" ||reg_tel == null){
                $("#reg_tel").focus;
                $("#tip").html("请输入手机号码")

            }



            else if(!myreg.test(reg_tel)){
                $("#reg_tel").focus;
                $("#tip").html("请输入11位手机号")
                setTimeout(function(){
                    document.getElementById("tip").innerHTML = "";
                }, 5000);
            }



            else if(reg_pas1 == "" ||reg_pas1 == null){
                $("#reg_pas1").focus;
                $("#tip").html("请输入密码")
                setTimeout(function(){
                    document.getElementById("tip").innerHTML = "";
                }, 5000);
            }

            else if(!reg.test(reg_pas1)){
                $("#reg_pas1").focus;
                $("#tip").html("请输入6-16个英文字母或数字的密码")
                setTimeout(function(){
                    document.getElementById("tip").innerHTML = "";
                }, 5000);
            }



            else if(reg_pas2 == "" ||reg_pas2 == null){
                $("#reg_pas2").focus;
                $("#tip").html("请再次输入密码")
                setTimeout(function(){
                    document.getElementById("tip").innerHTML = "";
                }, 5000);
            }




            else if(!reg.test(reg_pas2)){
                $("#reg_pas2").focus;
                $("#tip").html("请输入6-16个英文字母或数字的密码")
                setTimeout(function(){
                    document.getElementById("tip").innerHTML = "";
                }, 5000);
            }


            else if(reg_pas1!==reg_pas2){
                $("#reg_pas1").focus;

                $("#tip").html("两次输入密码不一致");
                setTimeout(function(){
                    document.getElementById("tip").innerHTML = "";
                }, 5000);

            }
            else{

                $.ajax({
                    method: "post",
                    url: "reg_sign.php",
                    data: regdata,

                    success: function(data)
                    {
                        result = data;
                        if(result="注册成功，请登录")
                        {

                            $('#register').modal('hide');
                            $('#login').modal('show');
                            $("#logintip").html("注册成功，请登录");
                            setTimeout(function(){
                                document.getElementById("logintip").innerHTML = "";
                            }, 5000);

                        }
                        else{
                            $("#tip").html(data);
                            setTimeout(function(){
                                document.getElementById("tip").innerHTML = "";
                            }, 5000);

                        }

                    }
                });

            }


        });




    });
</script>


</body>
</html>




