<?php
$username='13880478475';
$dbhost = 'localhost:3306'; // mysql服务器主机地址
$dbuser = 'root'; // mysql用户名
$dbpass = '@001xiaoshidaI'; // mysql用户名密码
$conn = mysqli_connect($dbhost, $dbuser, $dbpass);
mysqli_query($conn , "set names utf8");
mysqli_select_db($conn, 'test' );

$sql="select memstartdate from user where username='$username'";
$result=mysqli_query($conn,$sql);
$startdate = mysqli_fetch_assoc($result);
echo $startdate['memstartdate'];
$sql1="select memduedate from user where username='$username'";
$result1=mysqli_query($conn,$sql1);
$duedate = mysqli_fetch_assoc($result1);
echo $duedate['memduedate'];



?>