<?php

$dbhost = '39.105.188.97'; // mysql服务器主机地址
$dbuser = 'root'; // mysql用户名
$dbpass = '@001xiaoshidaI'; // mysql用户名密码
$conn = mysqli_connect($dbhost, $dbuser, $dbpass);


mysqli_query($conn , "set names utf8");
mysqli_select_db($conn, 'test' );

$sql = "select sendtel,alertid,content from todayalert WHERE  DATE_FORMAT(sendtime, '%Y-%m-%d %k:%i') = DATE_FORMAT(NOW(), '%Y-%m-%d %k:%i')";
$result=mysqli_query($conn,$sql);


if(!$result )
{
    die('无法读取数据: ' );
}
echo '<h2>菜鸟教程 mysqli_fetch_array 测试<h2>';

$senddata= mysqli_fetch_array($result);
if(!$senddata )
{
    die('kong: ' );
}
echo '<h2>菜鸟教程 mysqli_fetch_array 测试<h2>';

if(is_array($senddata)){
    echo '变量 $arr_site 是一个数组';
} else {
    echo '变量 $arr_site 不是一个数组';
}

for($i=0;$i<count($senddata);++$i) {
    $id = $senddata[$i][0];
    echo $id ;
    $content = $senddata[$i][1];
    $sendtel = $senddata[$i][2];

    function send_post($url, $post_data)
    {

        $postdata = http_build_query($post_data);
        $options = array(
            'http' => array(
                'method' => 'POST',
                'header' => 'Content-type:application/x-www-form-urlencoded',
                'content' => $postdata,
                'timeout' => 15 * 60 // 超时时间（单位:s）
            )
        );
        $context = stream_context_create($options);
        $result = file_get_contents($url, false, $context);

        return $result;
    }

//使用方法
    $post_data = array(
        'appid' => '21080',
        'to' => $sendtel,
        'content' => $content,
        'signature' => 'eb6e703a46ff308ea98bf44acc7e6234'

    );
    send_post('https://api.mysubmail.com/voice/send.json', $post_data);
    $resdata = send_post('https://api.mysubmail.com/voice/send.json', $post_data);
    $phpdata = json_decode($resdata, true);


    if ($phpdata['status'] == "success") {
        $sql = "update alertrecord(recordstate,alertid) VALUES($phpdata[status]','$phpdata[send_id]') WHERE recordid='$id'";

        $result = mysqli_query($conn, $sql);

        if (!$result) {
            die('1无法插入数据: ' . mysqli_error($conn));
        }
        echo "数据插入成功\n";
        $sql = "DELETE FROM todayalert
        WHERE alertid='$id'";

        mysqli_select_db($conn, 'test');
        $retval = mysqli_query($conn, $sql);
        if (!$retval) {
            die('无法删除数据: ' . mysqli_error($conn));
        }
        echo '数据删除成功！';
        mysqli_close($conn);


    } else {
        $sql1 = "update alertrecord(recordstate,msg) VALUES('$phpdata[status]','$phpdata[msg]') WHERE recordid='$id";
        $data = mysqli_query($conn, $sql1);
        if (!$data) {
            die('2无法插入数据: ' . mysqli_error($conn));
        }
        echo "数据插入成功\n";

        $sql = "DELETE FROM todayalert
        WHERE alertid='$id'";
        mysqli_select_db($conn, 'test');
        $retval = mysqli_query($conn, $sql);
        if (!$retval) {
            die('无法删除数据: ' . mysqli_error($conn));
        }
        echo '数据删除成功！';
        mysqli_close($conn);


    }
}


