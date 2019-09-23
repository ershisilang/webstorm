<?php

$t1 = microtime(true);
    $send_id = $_POST['send_id'];
$s_time = $_POST['timestamp'];
$send_time=date('Y-m-d H:i:s', $s_time);




if($_POST['events'] == 'delivered') {
    $dbhost = '39.105.188.97'; // mysql服务器主机地址
    $dbuser = 'root'; // mysql用户名
    $dbpass = '@001xiaoshidaI'; // mysql用户名密码
    $conn = mysqli_connect($dbhost, $dbuser, $dbpass);
    mysqli_query($conn , "set names utf8");
    mysqli_select_db($conn, 'test' );
    $sql = "update alertrecord set recordstate='发送成功',sendtime='$send_time' WHERE alertid='$send_id'";

    mysqli_query($conn,$sql);
    mysqli_close($conn);

}

else {
    $dbhost = '39.105.188.97'; // mysql服务器主机地址
    $dbuser = 'root'; // mysql用户名
    $dbpass = '@001xiaoshidaI'; // mysql用户名密码
    $conn = mysqli_connect($dbhost, $dbuser, $dbpass);
    mysqli_query($conn , "set names utf8");
    mysqli_select_db($conn, 'test' );

    $sql="UPDATE alertrecord SET recordstate='未接通' ，sendtime='$send_time' WHERE alertid='$send_id'";
    mysqli_query($conn,$sql);

    $sql1="select username from alertrecord where alertid='$send_id'";
    $result =mysqli_query($conn,$sql1);
    $row = mysqli_fetch_assoc($result);
    $sql4 = "update member set resnum=resnum+1 WHERE   DATE_FORMAT(NOW(), '%Y-%m-%d') BETWEEN DATE_FORMAT(startdate, '%Y-%m-%d')  AND DATE_FORMAT(duedate, '%Y-%m-%d') AND username='$row[username]'";
    mysqli_query($conn,$sql4);


}

$t2 = microtime(true);
$time=$t2- $t1;
$sqll=" INSERT INTO exctime(exctime1,excname) VALUES('$time','stockprice')";
mysqli_query($conn, $sqll);

mysqli_close($conn);




?>