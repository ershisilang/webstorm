<?php


$accept_tel=$_POST["tel"];
$content=$_POST["content"];
$sendtime=$_POST["time"];








if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["tel"])) {

        echo "请输入接收人手机号";
    }





    else if (empty($_POST["filename"])) {
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
        if (!$conn) {
            die('连接失败: ' . mysqli_error($conn));
        }
        echo '连接成功<br />';
// 设置编码，防止中文乱码
        mysqli_select_db($conn, 'test');
        mysqli_query($conn, "set names utf8");




        $sql = "INSERT INTO  alert  (sendtel,content,sendtime,)
     VALUES
     ('$accept_tel','$content','$sendtime')";

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