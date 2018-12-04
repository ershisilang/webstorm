<?php
session_start();

if (!isset($_SESSION['name'])) {

    header("Location:price1.html");
    exit;
}
?>



<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">

    <title>爱通知控制面板</title>

    <meta name="keywords" content=" 爱通知产品价格 语音通知价格">
    <meta name="description" content=" 选择爱通知产品版本，选择语音通知功能">


    <script>
        var _hmt = _hmt || [];
        (function() {
            var hm = document.createElement("script");
            hm.src = "https://hm.baidu.com/hm.js?24878ba02373ef0bb0a828acf30bb257";
            var s = document.getElementsByTagName("script")[0];
            s.parentNode.insertBefore(hm, s);
        })();
    </script>



    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script
            src="https://code.jquery.com/jquery-3.3.1.js"
            integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
            crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>


    <style type="text/css">


        #reg{font-weight:bold;
            color: #000000;

        }

        .navbar-brand{font-weight:bold;
            font-size:30px;
            color: #0084ff;

        }

        .nav{font-size:
            20px;

        }

        .nav-link{font-size:
            20px;
        }


        .display-4 {
            font-size: 50px;
            padding-top:0.5em;
            padding-bottom:0.5em;
        }







    </style>

</head>
<body>



<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">爱通知</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse  justify-content-end"   id="navbarSupportedContent">

        <ul class="nav navbar-nav navbar-right">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Dropdown
                </a>
                <div class="dropdown-menu  dropdown-menu-right" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" id="my" href="#">退出</a>

                </div>
            </li>
        </ul>

    </div>
</nav>


<div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
    <h1 class="display-4" id="check">选择版本，立即使用</h1>

</div>

<div class="container">
    <div class="card-deck mb-2 text-center">

        <div class="card mb-4 shadow-sm">
            <div class="card-header">
                <h4 class="my-0 font-weight-normal">包月</h4>
            </div>
            <div class="card-body">
                <h1 class="card-title pricing-card-title">15元 <small class="text-muted">/ 月</small></h1>
                <ul class="list-unstyled mt-3 mb-4">
                    <li>每月60次电话通知</li>

                </ul>
                <button type="button" class="btn btn-lg btn-block btn-primary">立即购买</button>
            </div>
        </div>
        <div class="card mb-4 shadow-sm">
            <div class="card-header">
                <h4 class="my-0 font-weight-normal">包年</h4>
            </div>
            <div class="card-body">
                <h1 class="card-title pricing-card-title">160元 <small class="text-muted">/（9折)年</small></h1>
                <ul class="list-unstyled mt-3 mb-4">
                    <li>每月60次电话通知</li>

                </ul>
                <button type="button" class="btn btn-lg btn-block btn-primary">立即购买</button>
            </div>
        </div>
    </div>


</div>





<!-- 注册窗口 -->
<div id="register" class="modal fade" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <button class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-title">
                <h2 class="text-center">title</h2>
            </div>

            <div id="textbox">
                <p class="alignleft">Text on the left.</p>
                <p class="alignright">Text on the right.</p>
            </div>


            <div id="textbox2">
                <p class="alignleft">Text on the left.</p>
                <p class="alignright">Text on the right.</p>
            </div>

            <div id="textbox3">
                <p class="alignleft">Text on the left.</p>
                <p class="alignright">Text on the right.</p>
            </div>

            <div class="modal-footer">
                <button type="button" id="ordersumbit" class="btn btn-primary btn-lg btn-block">agree</button>
            </div>







        </div>
    </div>
</div>






</body>
</html>


<script type="text/javascript">

    $(document).ready(function() {
        $.ajax({
            method: "post",
            url: "session.php",
            success: function(data)
            {   $("#check").html(data);


            }
        });


    });
</script>
