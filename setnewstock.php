<?php

$dbhost = 'localhost:3306'; // mysql服务器主机地址
$dbuser = 'root'; // mysql用户名
$dbpass = '@001xiaoshidaI'; // mysql用户名密码
$conn = mysqli_connect($dbhost, $dbuser, $dbpass);

/*
     if (!$conn) {
    die('连接失败: ' );
}
echo '连接成功<br />';
*/
// 设置编码，防止中文乱码
mysqli_select_db($conn, 'test');
mysqli_query($conn, "set names utf8");

$sql="SELECT stocknames FROM stocknum";
$row=mysqli_query($conn,$sql);
//var_dump ($row);
$senddata = array();
while ($row_user = mysqli_fetch_assoc($row))
    $senddata[] = $row_user;

//var_dump ($senddata);
$json1 = json_encode($senddata);
 echo $json1;
?>