<?php
    $send_id = $_POST['send_id'];

if($_POST['events'] == 'delivered') {
    $dbhost = '39.105.188.97'; // mysql服务器主机地址
    $dbuser = 'root'; // mysql用户名
    $dbpass = '@001xiaoshidaI'; // mysql用户名密码
    $conn = mysqli_connect($dbhost, $dbuser, $dbpass);
    mysqli_query($conn , "set names utf8");
    mysqli_select_db($conn, 'test' );
    $sql = "update alertrecord set recordstate='发送成功' WHERE alertid='$send_id'";

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

    $sql="UPDATE alertrecord SET recordstate='失败'  WHERE alertid='$send_id'";
    mysqli_query($conn,$sql);


    mysqli_close($conn);

}






?>