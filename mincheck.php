<?php

$dbhost = 'localhost:3306'; // mysql服务器主机地址
$dbuser = 'root'; // mysql用户名
$dbpass = '@001xiaoshidaI'; // mysql用户名密码
$conn = mysqli_connect($dbhost, $dbuser, $dbpass);


mysqli_query($conn , "set names utf8");
mysqli_select_db($conn, 'test' );

$sql = "select sendtel,alertid,content from todayalert ";
$result=mysqli_query($conn,$sql);



if(!$result )
{
    die('无法读取数据: ' );
}
echo '<h2>菜鸟教程 mysqli_fetch_array 测试<h2>';


while($profile = mysqli_fetch_array($result)){
    $senddata[] = $profile;
}

//print_r($senddata);

/*
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
*/
//print_r($senddata);




$num = count($senddata);
print_r($num);

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


for($i=0;$i<$num;$i++) {
    $sendtel = $senddata[$i][0];
    //echo $id ;
    $id = $senddata[$i][1];
    //echo $content ;
    $content = $senddata[$i][2];
    //echo $sendtel ;

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
              $sql = "UPDATE alertrecord SET recordstate='$phpdata[status]',alertid='$phpdata[send_id]'  WHERE recordid='$id'";

         $result = mysqli_query($conn, $sql);

              if (!$result) {
                  die('abc无法插入数据: ' . mysqli_error($conn));
              }
              echo "数据插入成功\n";
              $sql = "DELETE FROM todayalert
              WHERE alertid='$id'";

              mysqli_select_db($conn, 'test');
              $retval = mysqli_query($conn, $sql);
              if (!$retval) {
                  die('无法删除数据: ');
              }
              echo '数据删除成功！';



          } else {
              $sql1 = "UPDATE alertrecord  SET recordstate=$phpdata[status],msg=$phpdata[msg]  WHERE recordid='$id";
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



          }
}

mysqli_close($conn);
