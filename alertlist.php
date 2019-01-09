<?php
/*
session_start();
if (!isset($_SESSION['name'])) {

    header("Location:404.html");
    exit;
} else {

$username=$_SESSION['name'];
*/

ignore_user_abort(true);
set_time_limit(0);

$datetime = $sendtime;
$a = strtotime($datetime);
$reduce = $a-time();
sleep($reduce);
function send_post($url, $post_data)
{

    $postdata = http_build_query($post_data);
    $options = array(
        'http' => array(
            'method' => 'POST',
            'header' => 'Content-type:application/x-www-form-urlencoded',
            'content' => $postdata,
            'timeout' => 15 * 60 // 超时时间（单位:s）
        )
    );
    $context = stream_context_create($options);
    $result = file_get_contents($url, false, $context);

    return $result;
}

//使用方法
$post_data = array(
    'appid' => '21080',
    'to' => $accept_tel,
    'content' => $content,
    'signature' => 'eb6e703a46ff308ea98bf44acc7e6234'

);



send_post('https://api.mysubmail.com/voice/send.json', $post_data);
$resdata = send_post('https://api.mysubmail.com/voice/send.json', $post_data);
$phpdata = json_decode($resdata, true);

$dbhost = 'lcoalhost:3306'; // mysql服务器主机地址
$dbuser = 'sphinx'; // mysql用户名
$dbpass = '@001xiaoshidaI'; // mysql用户名密码
$conn = mysqli_connect($dbhost, $dbuser, $dbpass);
if (!$conn) {
    die('连接失败: ' . mysqli_error($conn));
}
echo '连接成功<br />';

mysqli_query($conn, "set names utf8");
mysqli_select_db($conn, 'test');


if ($phpdata['status'] == "success") {
    $sql = "INSERT  INTO alertrecord(username,recordstate,send_id) VALUES('$username','$phpdata[status]','$phpdata[send_id]')";

    $result = mysqli_query($conn, $sql);
    if (!$result) {
        die('无法插入数据: ' . mysqli_error($conn));
    }
    echo "数据插入成功\n";
    mysqli_close($conn);
} else {
    $sql1 = "INSERT  INTO alertrecord(username,recordstate,send_id,msg) VALUES('$username','$phpdata[status]','$phpdata[send_id]','$phpdata[msg]')";
    $data = mysqli_query($conn, $sql1);
    if (!$data) {
        die('无法插入数据: ' . mysqli_error($conn));
    }
    echo "数据插入成功\n";
    mysqli_close($conn);
    mysqli_close($conn);
}


$dbhost = 'localhost:3306'; // mysql服务器主机地址
$dbuser = 'root'; // mysql用户名
$dbpass = '@001xiaoshidaI'; // mysql用户名密码
$conn = mysqli_connect($dbhost, $dbuser, $dbpass);



mysqli_query($conn , "set names utf8");
mysqli_select_db($conn, 'test' );


$sql = "SELECT sendtime,sendtel,content,
	recordstate  FROM alertrecord";

    $result=mysqli_query($conn,$sql);
    /*
    if(! $result )
    {
        die('无法插入数据: ' . mysqli_error($conn));
    }
    echo "数据插入成功\n";
    */







?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Document</title>
    <script  src="https://code.jquery.com/jquery-3.3.1.js"            integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="            crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">

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
                    <a class="dropdown-item"    href="session.php">logout</a>
                    <a class="dropdown-item" href="#">Another action</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">Something else here</a>
                </div>
            </li>
        </ul>

    </div>
</nav>


<br /><br />
<div class="container">
    <div class="table-responsitive">
    <table class="table table-bordered">
        <table id="employee_data" class="table table-striped table-bordered">

        <thead>
        <tr>
            <th>发送时间</th>
            <th>接收人电话</th>
            <th>通知内容</th>
            <th>发送状态</th>

        </tr>
        </thead>
            <?php

            while($row = mysqli_fetch_assoc($result))
            {
                echo '
            <tr>
            <th>'.$row['sendtime'].'</th>
            <th>'.$row['sendtel'].'</th>    
            <th>'.$row['content'].'</th>     
            <th>'.$row['recordstate'].'</th>       
        </tr>      
             ';
            }
            ?>
        </table>
        </div>
</div>


</body>
</html>

<script>
$(document).ready(function()
{


    alert("出来了");



    $('#employee_data').DataTable({
        language: {
            "show": "显示",
            "sProcessing": "处理中...",
            "sLengthMenu": "显示 _MENU_ 项结果",
            "sZeroRecords": "没有匹配结果",
            "sInfo": "显示第 _START_ 至 _END_ 项结果，共 _TOTAL_ 项",
            "sInfoEmpty": "显示第 0 至 0 项结果，共 0 项",
            "sInfoFiltered": "(由 _MAX_ 项结果过滤)",
            "sInfoPostFix": "",
            "sSearch": "搜索:",
            "sUrl": "",
            "sEmptyTable": "表中数据为空",
            "sLoadingRecords": "载入中...",
            "sInfoThousands": ",",
            "oPaginate": {
                "sFirst": "首页",
                "sPrevious": "上页",
                "sNext": "下页",
                "sLast": "末页"
            },
            "oAria": {
                "sSortAscending": ": 以升序排列此列",
                "sSortDescending": ": 以降序排列此列"
            }
        }
    });

    $('#logout').click(function(){

        $.ajax({
            method: "post",
            url: "logout.php",




        });
    }

</script>


