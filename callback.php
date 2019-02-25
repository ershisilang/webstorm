<?php



$_POST['events'];//发送状态
$tel=$_POST['address'];//电话号码
$alertid=$_POST['send_id'];
$hold=$_POST['hold'];//通话时间
$answer_time=$_POST['answer_time'];//接听时间
$hangup_time=$_POST['hangup_time'];//挂断时间
$timestamp=$_POST['timestamp'];//时间出发时间
$signal=$_POST['signal'];//记录用户按的是哪个键，此时event参数必须等于signal


$dbhost = '39.105.188.97'; // mysql服务器主机地址
$dbuser = 'root'; // mysql用户名
$dbpass = '@001xiaoshidaI'; // mysql用户名密码
$conn = mysqli_connect($dbhost, $dbuser, $dbpass);


mysqli_query($conn , "set names utf8");
mysqli_select_db($conn, 'test' );





    if ($_POST['events'] == "delivered") {
        $sql1 = "update alertrecord(recordstate,sendtime) VALUES('success','$answer_time') WHERE alertid='$alertid'";

        $result = mysqli_query($conn, $sql1);

        if (!$result) {
            die('无法插入数据: ' . mysqli_error($conn));
        }
        echo "数据插入成功\n";

        $sql2= "DELETE FROM todayalert
        WHERE send_id='$alertid'";
        $retval = mysqli_query($conn, $sql2);
        if (!$retval) {
            die('无法删除数据: ' . mysqli_error($conn));
        }
        echo '数据删除成功！';
        mysqli_close($conn);


    }
    else if ($_POST['events'] == "signal") {
        $sql1 = "update alertrecord(pushbutton) VALUES('$signal') WHERE alertid='$alertid'";

        $result = mysqli_query($conn, $sql1);

        if (!$result) {
            die('无法插入数据: ' . mysqli_error($conn));
        }
        echo "数据插入成功\n";
    }



    else if ($_POST['events'] == "dropped") {

        $sql1 = "update alertrecord(recordstate,msg) VALUES('fail','call failed') WHERE alertid='$alertid'";

        $result = mysqli_query($conn, $sql1);

        if (!$result) {
            die('无法插入数据: ' . mysqli_error($conn));
        }
        echo "数据插入成功\n";

        $sql2= "DELETE FROM todayalert
        WHERE send_id='$alertid'";


        $retval = mysqli_query($conn, $sql2);
        if (!$retval) {
            die('无法删除数据: ' . mysqli_error($conn));
        }
        echo '数据删除成功！';
        mysqli_close($conn);

    }







