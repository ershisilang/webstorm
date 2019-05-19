<?php


//每天晚上11:40开始跑一次
$dbhost = '39.105.188.97'; // mysql服务器主机地址
$dbuser = 'root'; // mysql用户名
$dbpass = '@001xiaoshidaI'; // mysql用户名密码
$conn = mysqli_connect($dbhost, $dbuser, $dbpass);

mysqli_query($conn , "set names utf8");
mysqli_select_db($conn, 'test' );

$sql = "insert into todayalert('alertid','sendtime','sendtel','content') select'recordid','sendtime','sendtel','content' from alertrecord 
WHERE sendtime=CURDATE() + 1";
mysqli_query($conn,"$sql");
mysqli_close($conn);

