<?php



$dbhost = '39.105.188.97'; // mysql服务器主机地址
$dbuser = 'root'; // mysql用户名
$dbpass = '@001xiaoshidaI'; // mysql用户名密码


$conn = mysqli_connect($dbhost, $dbuser, $dbpass);
mysqli_query($conn , "set names utf8");
mysqli_select_db($conn, 'test' );





$sql = "select sendtel,alertid,content from todayalert WHERE  DATE_FORMAT(sendtime, '%Y-%m-%d %k:%i') = DATE_FORMAT(NOW(), '%Y-%m-%d %k:%i')";
$result=mysqli_query($conn,$sql);


$senddata = array();

while ($row_user = mysqli_fetch_assoc($result))
    $senddata[] = $row_user;


if(!$result )
{
    die('无法读取数据: ' );
}
echo '<h2>菜鸟教程 mysqli_fetch_array 测试<h2>';


var_dump ($senddata);
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


for($i=0;$i<count($senddata);++$i) {

    $sendtel = $senddata[$i]['sendtel'];
    //echo $sendtel ;
   $id = $senddata[$i]['alertid'];
 //echo $id;
    $content = $senddata[$i]['content'];
    //echo $content;



//使用方法
    $post_data = array(
        'appid' => '21080',
        'to' => $sendtel,
        'content' => $content,
        'signature' => 'eb6e703a46ff308ea98bf44acc7e6234'

    );

    $resdata = send_post('https://api.mysubmail.com/voice/send.json', $post_data);
    $phpdata = json_decode($resdata, true);
    var_dump ($phpdata);

    if ($phpdata['status'] == "success") {
        $sql = "update alertrecord set recordstate='正在发送', alertid='$phpdata[send_id]' WHERE recordid='$id'";

        $result = mysqli_query($conn, $sql);

        if (!$result) {
            die('无法插入数据: ' . mysqli_error($conn));
        }
        echo "数据插入成功\n";

        $sql1 = "DELETE FROM todayalert
        WHERE alertid='$id'";
        mysqli_select_db($conn, 'test');

        $retval = mysqli_query($conn, $sql1);
        if (!$retval) {
            die('无法删除数据: ' . mysqli_error($conn));
        }
        echo '数据删除成功！';




    } else {

        $sql2 = "update alertrecord set recordstate='fail', msg='$phpdata[msg]' WHERE recordid='$id'";
        $result1 = mysqli_query($conn, $sql2);
        $sql5="select username from alertrecord where recordid='$id'";
        $result =mysqli_query($conn,$sql5);
        $row = mysqli_fetch_assoc($result);
        $sql4 = "update member set resnum=resnum+1 WHERE   DATE_FORMAT(NOW(), '%Y-%m-%d') BETWEEN DATE_FORMAT(startdate, '%Y-%m-%d')  AND DATE_FORMAT(duedate, '%Y-%m-%d') AND username='$row[username]'";
        mysqli_query($conn,$sql4);
        if (!$result1) {
            die('无法插入数据: ' . mysqli_error($conn));
        }
        echo "数据插入成功\n";


    }
}
mysqli_close($conn);


