//注册模块
<?php 
    header("Content-Type: text/html; charset=utf8");

    if(!isset($_POST['submit'])){
        exit("错误执行");
    }//判断是否有submit操作

    $username=$_POST['reg_tel'];
    $password=$_POST['reg_pas2'];
    $tel=$_POST['reg_tel'];
    
   
    //数据存到session，初始化格式可能有点问题


$dbhost = 'localhost:3306'; // mysql服务器主机地址
$dbuser = 'root'; // mysql用户名
$dbpass = '@001xiaoshidaI'; // mysql用户名密码
$conn = mysqli_connect($dbhost, $dbuser, $dbpass);
if(! $conn )
{
die('连接失败: ' . mysqli_error($conn));
}
echo '连接成功<br />';
// 设置编码，防止中文乱码
mysqli_query($conn , "set names utf8");

mysqli_select_db($conn, 'test' );

    $sql="insert into user(username,tel,password) values ('$username','$username','$password')";//向数据库插入表单传来的值的sql
    
    mysqli_select_db( $conn, 'test' );
    $reslut=mysqli_query($conn,$sql);//执行sql

if(!$reslut )
{
    die('无法插入数据: ' . mysqli_error($conn));
}
echo "数据插入成功\n";


mysqli_close($conn);
    
    ?>