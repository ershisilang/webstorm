<?php


$name=$_POST['name'];
$WIDout_trade_no=$_POST['WIDout_trade_no1'];

$dbhost = '39.105.188.97'; // mysql服务器主机地址
$dbuser = 'sphinx'; // mysql用户名
$dbpass = '@001xiaoshidaI'; // mysql用户名密码
$conn = mysqli_connect($dbhost, $dbuser, $dbpass);





mysqli_query($conn , "set names utf8");
mysqli_select_db($conn, 'test' );
$sql="INSERT  INTO money_record (username,tradenum,transaction_state) VALUES('$name','$WIDout_trade_no','0')";
mysqli_query($conn,"$sql");

mysqli_close($conn);

?>
