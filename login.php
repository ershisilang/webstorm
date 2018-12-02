
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
        $sql1 = "SELECT numcheck FROM user WHERE username='$username' AND password='$password' ";//检测次数是否用尽
        $result1=mysqli_query($conn,$sql1);
        $numcheck = mysqli_fetch_array($result);

        $sql2 = "SELECT duecheck FROM user WHERE username='$username' AND password='$password'";//检测是否到期
        $result2=mysqli_query($conn,$sql2);
        $duecheck = mysqli_fetch_array($result2);


        $sql3 = "SELECT is_member FROM user WHERE username='$username' AND password='$password'";
        $result3=mysqli_query($conn,$sql3);
        $ismember = mysqli_fetch_array($result3);
        //开启一个会话,保存用户名（手机号)，剩余次数，到期时间
        session_start();
        $_SESSION['name'] = $username;
        $_SESSION['numcheck']=$numcheck['numcheck'];
        $_SESSION['duecheck']=$duecheck['duecheck'];
        $_SESSION['ismember']= $ismember['is_member'];


        echo "<script language='javascript' type='text/javascript'>";
        echo "window.location.href='./afterlogin2.php'";
        echo "</script>";

    }else{

      echo "用户名或密码错误";


    }


}else{//如果用户名或密码有空
    echo "请输入手机号或密码";



}

mysqli_close($conn);
?>


