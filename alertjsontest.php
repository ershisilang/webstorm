<?php
// 从文件中读取数据到PHP变量
$json_string = file_get_contents('./package.json');

// 用参数true把JSON字符串强制转成PHP数组
$data = json_decode($json_string, true);
if(! $data )
{
    die('1: ' . mysqli_error($conn));
}
echo "2\n";

$filewebid=$data->$id;
$filestate=$data->$state;

$dbhost = '39.105.188.97:3306'; // mysql服务器主机地址
$dbuser = 'admin'; // mysql用户名
$dbpass = '@001xiaoshidaI'; // mysql用户名密码
$conn = mysqli_connect($dbhost, $dbuser, $dbpass);

/*
if(! $conn )
{
die('连接失败: ' . mysqli_error($conn));
}
echo '连接成功<br />';
// 设置编码，防止中文乱码
*/
mysqli_query($conn , "set names utf8");
mysqli_select_db($conn, 'alert' );

$sql="update alert set alert_audit_state=REPLACE (alert_audit_state,'ready','$filestate') where name=$filewebid";
$retval = mysqli_query( $conn, $sql );



if(! $retval )
{
    die('无法插入数据: ' . mysqli_error($conn));
}
echo "数据插入成功\n";
mysqli_close($conn);




?>




