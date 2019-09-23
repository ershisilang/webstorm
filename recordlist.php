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
/*
 会员表是否有一条记录，主要针对alertlist
$sql7="SELECT memduedate FROM user where username='$username'";
$row1=mysqli_query($conn,$sql8);
$duedate = mysqli_fetch_array($row1);
  */


//如果没有付过费
$sqlf = "SELECT * FROM member WHERE username=$username";
$result1 = mysqli_query($conn, $sqlf);
$rows1 = mysqli_num_rows($result1);
if (!$rows1) {
    echo "<script language='javascript' type='text/javascript'>";
    echo "window.location.href='./afterlogin2.php'";
    echo "</script>";

}
$result = mysqli_query($conn,"SELECT content,sendtel,sendtime,recordstate FROM alertrecord where username='$username'");

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
    <a class="navbar-brand" href="#">爱提醒管理后台</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item ">
                <a class="nav-link" href="uploadtext.php">发送提醒 <span class="sr-only">(current)</span></a>
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

<br /><br />
<div class="container">
    <div class="table-responsitive">
        <table class="table table-bordered">
            <table id="employee_data" class="table table-striped table-bordered">

                <thead>
                <tr>
                    <th>接收电话</th>
                    <th>发送时间</th>
                    <th>发送内容</th>
                    <th>发送状态</th>
                </tr>
                </thead>
                <?php

                while($row = mysqli_fetch_array($result))
                {
                    echo '
            <tr>            
            <th>'.$row["sendtel"].'</th>            
            <th>'.date("Y-m-d H:i",strtotime( $row["sendtime"] )).'</th>           
            <th>'.$row["content"].'</th>   
            <th>'.$row["recordstate"].'</th>         
             <th>'.$row["alerttype"].'</th>    
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
                "sEmptyTable": "您还没有发送记录",
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
    });


</script>