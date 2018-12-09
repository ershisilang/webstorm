<?php
require "./qcloudsms_php/src/index.php";

use Qcloud\Sms\SmsVoicePromptSender;


$appid =1400166420; // 1400开头
// 短信应用SDK AppKey
$appkey = "e4bed6323edb904de137ccb172a484be";
// 需要发送短信的手机号码
$phoneNumbers = ["13880478475", "15114097143"];

// 定义变量并默认设置为空值

$accept_tel=$_POST["tel"];
$filename=$_POST["filename"];
$sendtime=$_POST["time"];








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

 else {




     try {
         $vpsender = new SmsVoicePromptSender($appid, $appkey);
         $result = $vpsender->send("86", $phoneNumbers[0], 2, "5678", "");
         $rsp = json_decode($result);
         echo $result;
     } catch (\Exception $e) {
         echo var_dump($e);
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




     $sql = "INSERT INTO  alert  (sendtel,filename,sendtime, filepath,alert_audit_state)
     VALUES
     ('$accept_tel','$filename','$sendtime','$dir','0')";

     $result = mysqli_query($conn, $sql);
     if (!$result) {
         die('无法插入数据: ' . mysqli_error($conn));
     }
     echo "数据插入成功\n";
     mysqli_close($conn);
     echo "<script language='javascript' type='text/javascript'>";
     echo "window.location.href='./alertlist.php'";
     echo "</script>";
 }



//插入成功，向接口发送ajax请求，回调函数再次插入数据库改变状态



}





?>