
<?php 

$username=$_POST['reg_tel'];
$password=$_POST['reg_pas1'];
$password2=$_POST['reg_pas2'];
    

$dbhost = 'localhost:3306'; // mysql服务器主机地址
$dbuser = 'root'; // mysql用户名
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
mysqli_select_db($conn, 'test' );
$sql="SELECT tel FROM user WHERE tel= '$username'";
   $result=mysqli_query($conn,"$sql");
   $num = mysqli_num_rows($result);
   if(!$username||!$password||!$password2)
   {
       echo"请输入手机号或密码。";
   }
   else
       if($num==1)
           {
               echo "手机号已注册，请登录或更换其他手机号注册";
           }

               else
                   if($password!=$password2)
                   {
                       echo"密码不一致，请重新输入";
                   }
                   else
                   {
                      mysqli_query($conn,"insert into user(username,tel,password,)values ('$username',$username','$password2')");
                       echo"注册成功，请登录";
                   }

mysqli_close($conn);
    
    ?>
