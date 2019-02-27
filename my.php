<?php
$username='13880478471';
$dbhost = 'localhost:3306'; // mysql服务器主机地址
$dbuser = 'root'; // mysql用户名
$dbpass = '@001xiaoshidaI'; // mysql用户名密码
$conn = mysqli_connect($dbhost, $dbuser, $dbpass);
mysqli_query($conn , "set names utf8");
mysqli_select_db($conn, 'test' );

$sql="select memstartdate from user where username='$username'";
$result=mysqli_query($conn,$sql);
$startdate = mysqli_fetch_assoc($result);

$sql1="select memduedate from user where username='$username'";
$result1=mysqli_query($conn,$sql1);
$duedate = mysqli_fetch_assoc($result1);
echo $startdate["memstartdate"];
echo $duedate["memduedate"];

$sql2='SELECT COUNT(*) FROM alertrecord WHERE  DATE(sendtime)BETWEEN STR_TO_DATE("$startdate[memstartdate]", "%Y-%m-%d")  AND STR_TO_DATE("$duedate[memduedate]", "%Y-%m-%d")  ';
//$sql2='SELECT sendtime FROM alertrecord WHERE  DATE_FORMAT(sendtime,"%d/%m/%Y") AS formatted_date BETWEEN "$startdate"["memstartdate"] AND "$duedate"["memduedate"] ';
$result2=mysqli_query($conn,$sql2);
if(!$result2 )
{
    die('无法读取数据ff : ' );
}
echo '<h2>菜鸟教程 mysqli_fetch_array 测试<h2>';
$row = mysqli_fetch_row($result2);
$res = $row[0];
echo $res;

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
                    <a class="dropdown-item" id="my" href="#">退出账号</a>
                </div>
            </li>
        </ul>

    </div>
</nav>




<div class="container">

    <div class="down">
        <p id="startdate">1</p>
        <p id="duedate">2</p>
        <p id="resnum">3</p>
    </div>

</div>

<script>

    var startdate = "<?php echo $startdate['memstartdate']; ?>";
    var duedate = "<?php echo $duedate['memduedate']; ?>";
    var resnum = "<?php echo $res['resnum']; ?>";
    document.getElementById('startdate').innerHTML = "您的会员开始时间为"+startdate ;
    document.getElementById('duedate').innerHTML = "您的会员结束时间为"+duedate ;
    document.getElementById('resnum').innerHTML = "您的剩余次数为"+resnum+"次";
</script>

</body>
</html>




