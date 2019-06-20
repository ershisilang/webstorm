<?php

session_start();

$username=$_SESSION['name'];

if (!isset($_SESSION['name'])) {

    header("Location:index.html");
    exit;
};
$dbhost = 'localhost:3306'; // mysql服务器主机地址
$dbuser = 'root'; // mysql用户名
$dbpass = '@001xiaoshidaI'; // mysql用户名密码
$conn = mysqli_connect($dbhost, $dbuser, $dbpass);
mysqli_query($conn , "set names utf8");
mysqli_select_db($conn, 'test' );

//如果没有付过费
$sqlf = "SELECT * FROM member WHERE username=$username";
$result1 = mysqli_query($conn, $sqlf);
$rows1 = mysqli_num_rows($result1);
if (!$rows1) {
    echo "<script language='javascript' type='text/javascript'>";
    echo "window.location.href='./afterlogin2.php'";
    echo "</script>";

}

//如果付过费，查看会员是否过期

$sql5 = "SELECT startdate,duedate,resnum FROM member WHERE   DATE_FORMAT(NOW(), '%Y-%m-%d') BETWEEN DATE_FORMAT(startdate, '%Y-%m-%d')  AND DATE_FORMAT(duedate, '%Y-%m-%d') AND username=$username";
$result2 = mysqli_query($conn, $sql5);
$rows2 = mysqli_num_rows($result2);
$result3 = mysqli_fetch_assoc($result2);


if ($rows2>0) {
    $is_member="正常";
    $startdate = $result3['startdate'];
    $duedate = $result3['duedate'];
    $resnum = $result3['resnum'];
}

else {
    $is_member="已过期,请立即充值";
    $startdate = "已过期,请立即充值";
    $duedate = "已过期,请立即充值";
    $resnum = "已过期,请立即充值";

}

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">

    <title>fd</title>

    <meta name="keywords" content=" dfd">
    <meta name="description" content=" fdfd">


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
                <a class="nav-link" href="uploadtext.php">发送提醒 <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="recordlist.php">提醒记录</a>
            </li>

            <li class="nav-item active">
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



<div class="mem">
    <span style="color:blue">会员状态:</span>
    <span style="color:blue"  id="curstate">2</span>
</div>


<div class="start">
    <span style="color:blue">开始时间:</span>
    <span style="color:blue"  id="startdate">1</span>
    </div>

<div class="due">
    <span style="color:blue">结束时间:</span>
    <span style="color:blue"  id="duedate">2</span>
</div>

<div class="res">
    <span style="color:blue">剩余次数:</span>
    <span style="color:blue"  id="resnum">3</span>
</div>

<div class="charge">
    <span style="color:blue"  id="charge"">选择套餐:</span>
    <select id="select" >
        <option>15元/月</option>
        <option>160元/年（9折）</option>
    </select>
    <button type="button" id="pay" >充值</button>
</div>



<script>
    var curstate = <?php echo json_encode($is_member) ?>;
        document.getElementById("curstate").innerHTML = curstate;



    var startdate = <?php echo json_encode($startdate) ?>;
    document.getElementById("startdate").innerHTML = startdate;

    var duedate = <?php echo json_encode($duedate) ?>;
    document.getElementById("duedate").innerHTML = duedate;

    var resnum = <?php echo json_encode($resnum) ?>;
    document.getElementById("resnum").innerHTML = resnum;






    $('#pay').click(function(){

        var name;
        name="<?php echo $username;?>";
        var WIDout_trade_no1="";  //订单号
        for(var i=0;i<6;i++) //6位随机数，用以加在时间戳后面。
        {
            WIDout_trade_no1 += Math.floor(Math.random()*10);
        }
        WIDout_trade_no1 = new Date().getTime() + WIDout_trade_no1;  //时间

        var resdata = "WIDout_trade_no1=" + WIDout_trade_no1 + "&name=" + name;

        $.ajax({
                method: "post",
                url: "insertorder.php",
                data:resdata,
            }
        );


        var form = $("<form method='post'></form>");
        form.attr({"action":"alipay.trade.page.pay-PHP-UTF-8/pagepay/pagepay.php"});



        var input1 = $("<input type='hidden'>").attr("name", "WIDout_trade_no").val(WIDout_trade_no1);
        var input2 = $("<input type='hidden'>").attr("name", "WIDsubject").val("爱通知包月套餐15.00元" );
        var input3 = $("<input type='hidden'>").attr("name", "WIDbody").val("包月" );
        if($("#select option:selected").text()=='15元/月')
        {
            var input4 = $("<input type='hidden'>").attr("name", "WIDtotal_amount").val("0.15");
        }
        else{
            var input4 = $("<input type='hidden'>").attr("name", "WIDtotal_amount").val("0.16");;
        }
        form.append(input1);
        form.append(input2);
        form.append(input3);
        form.append(input4);
// 这步很重要，如果没有这步，则会报错无法建立连接
        $("body").append($(form));
        form.submit();



    }  );

</script>

</body>
</html>




