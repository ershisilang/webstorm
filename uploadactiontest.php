<?php
// 定义变量并默认设置为空值

$accept_tel=$_POST["tel"];
$filename=$_POST["filename"];
$sendtime=$_POST["time"];




/*



if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["tel"])) {

        echo "请输入接收人手机号";
    }





 else if (empty($_POST["filename"])) {
     echo "请输入文件名（汉字或英文字母）";

 }



 else if (empty($_POST["time"])) {
     echo "请xuanzetime";
 }

 //音频文件
 else if ((($_FILES['file']['type'] !== "audio/wma")
     || ($_FILES['file']['type'] !== "audio/mp3"))) {

     echo "请上传mp3或wav格式的音频文件";

 }

 else if ($_FILES['file']['size'] < 200) {

     echo "音频文件大小需小于400k";



 }


 $dir = 'upload/'.iconv('UTF-8', 'gbk', basename($_FILES['file']['name']));

 //将用户上传的文件保存到upload目录中
 if (move_uploaded_file($_FILES['file']['tmp_name'], $dir)) {
     echo '文件上传成功';
 } else {
     echo '文件上传失败';
 }

//插入数据库;插入提醒表;修改数据库密码

 $dbhost = 'localhost:3306'; // mysql服务器主机地址
 $dbuser = 'root'; // mysql用户名
 $dbpass = '@001xiaoshidaI'; // mysql用户名密码
 $conn = mysqli_connect($dbhost, $dbuser, $dbpass);
 if (!$conn) {
     die('连接失败: ' . mysqli_error($conn));
 }
 echo '连接成功<br />';
// 设置编码，防止中文乱码
mysqli_select_db($conn, 'test');
 mysqli_query($conn, "set names utf8");




$sql = "INSERT INTO  alert  (sendtel,filename,sendtime, filepath)
     VALUES
     ('$accept_tel','$filename','$sendtime','$dir')";

 $result = mysqli_query($conn, $sql);
 if (!$result) {
     die('无法插入数据: ' . mysqli_error($conn));
 }
 echo "数据插入成功\n";
 mysqli_close($conn);


//插入成功，向接口发送ajax请求，回调函数再次插入数据库改变状态



}
*/
header("404.html");


?>