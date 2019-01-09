<?php
session_start();

$_SESSION['name'] = '13880478475';
$username=$_SESSION['name'];
function send_post($url, $post_data) {

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
    'to' => '13880478475',
    'content' => ' 父母身体健康父母身体健康父母身体健康父母身体健康父母身体健康父母身体健康父母身体健康父母身体健康父母身体健康',
    'signature' => 'eb6e703a46ff308ea98bf44acc7e6234'

);
send_post('https://api.mysubmail.com/voice/send.json', $post_data);
$resdata=send_post('https://api.mysubmail.com/voice/send.json', $post_data);
$phpdata = json_decode($resdata,true);

$dbhost = '39.105.188.97'; // mysql服务器主机地址
$dbuser = 'sphinx'; // mysql用户名
$dbpass = '@001xiaoshidaI'; // mysql用户名密码
$conn = mysqli_connect($dbhost, $dbuser, $dbpass);
if (!$conn) {
    die('连接失败: ' . mysqli_error($conn));
}
echo '连接成功<br />';

mysqli_query($conn , "set names utf8");
mysqli_select_db($conn, 'test' );


if($phpdata['status']=="success")
{
    $sql ="INSERT  INTO alertrecord(username,recordstate,send_id) VALUES('$username','$phpdata[status]','$phpdata[send_id]')";

    $result = mysqli_query($conn, $sql);
    if (!$result) {
        die('无法插入数据: ' . mysqli_error($conn));
    }
    echo "数据插入成功\n";
    mysqli_close($conn);
}
else
{
    $sql1 ="INSERT  INTO alertrecord(username,recordstate,send_id,msg) VALUES('$username','$phpdata[status]','$phpdata[send_id]','$phpdata[msg]')";
      $data = mysqli_query($conn, $sql1);
    if (!$data) {
        die('无法插入数据: ' . mysqli_error($conn));
    }
    echo "数据插入成功\n";
    mysqli_close($conn);
mysqli_close($conn);
}




