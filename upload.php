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
            width:20em;;
        }


        #time{
            width:20em;;
        }


    </style>

</head>
<body>



<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">Navbar</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Link</a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="#">Link</a>
            </li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Dropdown
                </a>
                <div class="dropdown-menu  dropdown-menu-right" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" id="my" href="#">my</a>
                    <a class="dropdown-item" href="#">Another action</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">Something else here</a>
                </div>
            </li>
        </ul>

    </div>
</nav>

<script src="layer.js的路径"></script>

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
        <label for="name">时间</label><br>
        <input type="text" id="time" name="time" placeholder="请选择日期">
    </div>




    <div class="form-group">
        <label for="name">name</label>
        <input type="text" class="form-control" id="filename" name="filename"
               placeholder="请输入文件名称，必填">
    </div>




            <div class="form-group">
                <label for="inputfile">文件输入</label>
                <input type="file" name ="file" id="file">
                <span>some text.</span>
            </div>
            <div style="color:#F00" id="uploadtip"></div>
            <button type="button" class="btn btn-default" id="button">提交</button>


</div>

        <!-- 前端校验  -->
        <script>


            $('#button').click(function(){

                document.getElementById("uploadtip").innerText == '';


                var myreg = /^(((13[0-9]{1})|(15[0-9]{1})|(18[0-9]{1}))+\d{8})$/;//校验手机

                var regex = /^[u4e00-u9fa5·0-9A-z]+$/;//校验文件名

                var tel = $("#tel").val();
                var filename = $("#filename").val();
                var time = $("#time").val();
                var file = document.getElementById("file").files[0];


                var fm = new FormData();

                fm.append('tel', tel);
                fm.append('filename', filename);
                fm.append('time', time);
                fm.append('file', file);

                if(tel == "" ||tel == null){
                    $("#tel").focus;
                    $("#uploadtip").html("请输入手机号码")

                }


                           else if(!myreg.test(tel)){
                               $("#tel").focus;
                               $("#uploadtip").html("请输入正确格式的手机号")
                           }




                           else    if(!regex.test(filename)){
                                   $("#filename").focus;
                                   $("#uploadtip").html("请输入文件名")

                           }



                           else if(time == "" ||time== null){
                               $("#time").focus;
                               $("#uploadtip").html("请选择发送时间")
                           }

                           else if(file == "" ||file== null){
                               $("#inputfile").focus;
                               $("#uploadtip").html("请上传文发的地方件")
                           }




                           else{
                               $.ajax(
                                   {
                                       url: 'uploadactiontest.php',
                                       type: 'POST',
                                       data: fm,
                                       contentType: false, //禁止设置请求类型
                                       processData: false, //禁止jquery对DAta数据的处理,默认会处理
                                       //禁止的原因是,FormData已经帮我们做了处理
                                       success: function (data) {
                                           $("#uploadtip").html(data);

                                       }
                                   }
                               );
                           }
                       });


</script>


</body>
</html>

