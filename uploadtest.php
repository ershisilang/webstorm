<?php
//var_dump($_POST);
session_start();

$username=$_SESSION['name'];

if (!isset($_SESSION['name'])) {

    header("Location:index.html");
    exit;
};
$accept_tel = explode(',',$_POST['tel']);
//$accept_tel = json_decode($_POST['tel'],TRUE);
//var_dump($accept_tel);
/*
  if(is_array($accept_tel)){
  echo '变量 $arr_age 是一个数组';
} else {
  echo '变量 $arr_age 不是一个数组';
}
  */


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
  else if (date('YmdH:i', strtotime($_POST["time"]))< date('YmdH:i')) {
      echo "请选择当前时间之后的时间";
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

      $sql9="SELECT resnum FROM member WHERE   DATE_FORMAT(NOW(), '%Y-%m-%d') BETWEEN DATE_FORMAT(startdate, '%Y-%m-%d')  AND DATE_FORMAT(duedate, '%Y-%m-%d') AND username=$username";
      $row=mysqli_query($conn,$sql9);
      $resnum = mysqli_fetch_array($row);

      if ($resnum["resnum"]<sizeof($accept_tel)) {
          echo "发送条数超过会员期内剩余次数，请充值";
          exit;
      }

      for ($i=0;$i<sizeof($accept_tel);$i++) {

          if(date('Ymd') == date('Ymd', strtotime($sendtime))){
              $sql = "INSERT INTO  alertrecord  (sendtel,content,sendtime,recordstate,alerttype)
   VALUES     ('$accept_tel[$i]','$content','$sendtime','待发送','事件')";
              mysqli_query($conn,$sql);
              $sql4 = "update member set resnum=resnum-1 WHERE username=$username";
              mysqli_query($conn,$sql4);
              $orderid = mysqli_insert_id(($conn));
              $sql2 = "INSERT INTO  todayalert  (sendtel,content,sendtime,alertid)
   VALUES     ('$accept_tel[$i]','$content','$sendtime','$orderid')";
              mysqli_query($conn,$sql2);

              /*
              echo "<script language='javascript' type='text/javascript'>";
              echo "window.location.href='./alertlist.php'";
              echo "</script>";
              */
            }
            else{
                $sql3 = "INSERT INTO  alertrecord  (sendtel,content,sendtime,recordstate,alerttype)
   VALUES     ('$accept_tel[$i]','$content','$sendtime','待发送','事件')";
                mysqli_query($conn,$sql3);

                $sql4 = "update member set resnum=resnum-1 WHERE username=$username";
                mysqli_query($conn,$sql4);

                /* echo "<script language='javascript' type='text/javascript'>";
                echo "window.location.href='./alertlist.php'";
                echo "</script>";
                */
            }

        };
      mysqli_close($conn);
      echo "已添加成功";

    }
}
?>