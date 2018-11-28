
<?php

$username=$_POST['login_tel'];
$password=$_POST['login_pas'];

$dbhost = 'localhost:3306'; // mysql服务器主机地址
$dbuser = 'root'; // mysql用户名
$dbpass = '@001xiaoshidaI'; // mysql用户名密码
$conn = mysqli_connect($dbhost, $dbuser, $dbpass);



mysqli_query($conn , "set names utf8");
mysqli_select_db($conn, 'test' );
if ($username && $password){//如果用户名和密码都不为空
   $sql = "SELECT * FROM user WHERE username='$username' AND password='$password'";//检测数据库是否有对应的username和password的sql


    $result=mysqli_query($conn,$sql);
    $rows = mysqli_num_rows($result);
    if($rows){//0 false 1 true
        echo "<script language='javascript' type='text/javascript'>";
        echo "window.location.href='./index_alreadylogin.html'";
        echo "</script>";

    }else{

      echo "用户名或密码错误";


    }


}else{//如果用户名或密码有空
    echo "请输入手机号或密码";



}

mysqli_close($conn);
?>


