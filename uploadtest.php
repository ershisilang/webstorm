<?php

$accept_tel= explode("，",$_POST['tel']);
//$accept_tel = json_decode($_POST['tel'],TRUE);
var_dump($accept_tel);

if(is_array($accept_tel)){
  echo '变量 $arr_age 是一个数组';
} else {
  echo '变量 $arr_age 不是一个数组';
}

$content=$_POST["content"];
$sendtime=$_POST["time"];
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["tel"])) {
      echo "请输入接收人手机号";
  }
  else if (empty($_POST["content"])) {
      echo "请输入电话通知内容";
  }
  else if (empty($_POST["time"])) {
      echo "请选择发送电话时间";
  }
  else {
//插入数据库;插入提醒表;修改数据库密码
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



      for ($i=0;$i<sizeof($accept_tel);$i++) {

          if(date('Ymd') == date('Ymd', strtotime($sendtime))){
              $sql = "INSERT INTO  alertrecord  (sendtel,content,sendtime)
   VALUES     ('$accept_tel[i]','$content','$sendtime')";
              mysqli_query($conn,$sql);
              $orderid = mysqli_insert_id(($conn));
              $sql2 = "INSERT INTO  todayalert  (sendtel,content,sendtime,alertid)
   VALUES     ('$accept_tel[i]','$content','$sendtime','$orderid')";
              mysqli_query($conn,$sql2);
              mysqli_close($conn);
              /*
              echo "<script language='javascript' type='text/javascript'>";
              echo "window.location.href='./alertlist.php'";
              echo "</script>";
              */
            }
            else{
                $sql = "INSERT INTO  alertrecord  (sendtel,content,sendtime)
     VALUES     ('$accept_tel[i]','$content','$sendtime')";
                mysqli_query($conn,$sql);
                mysqli_close($conn);
                /* echo "<script language='javascript' type='text/javascript'>";
                echo "window.location.href='./alertlist.php'";
                echo "</script>";
                */
            }

        };

    }
}
?>