<?php


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

$sql0="SELECT stocode from stocknum";
$rows0 = mysqli_query($conn, $sql0);

$senddata0 = array();

while ($senddata0 = mysqli_fetch_assoc($rows0))
    $select[] = $senddata0;

//var_dump ($select);
//下一步是直接把selcec转换为字符串,二维数组转1维数组
for($n=0;$n<count($select);++$n) {
    $rselect[] = $select[$n]['stocode'];
}
//var_dump($rselect);
$fselect = implode( ",", $rselect ) ;
//echo ($fselect);


header("Content-Type:text/html;charset=gb2312");
header("Access-Control-Allow-Origin: http://hq.sinajs.cn/");

$stockInfoString = file_get_contents("http://hq.sinajs.cn/list=$fselect");
//$stockInfoString = iconv("gb2312", "utf-8//IGNORE",$stockInfoString);

$result=explode(";",$stockInfoString);//将返回的字符串根据逗号分割为字符串
array_pop($result);
//print_r($result);
//var_dump($result);

/*
$sresult = explode(",", $result[0]);
//var_dump($sresult);
var_dump($sresult[0]);
*/


for($m=0;$m<count($result);++$m) {
    $sresult = explode(",", $result[$m]);
    // 根据正则表达式提取股票名称
    $sname = $sresult[0] ."\"";
    $sname = preg_match_all('/\"(.*?)\"/', $sname, $matches);
    $sname=str_replace("\"","",$matches[0][0]);

    $mstockInfo = array();
    $mstockInfo[0]=$sname;
    $mstockInfo[1]=$sresult[1];


    $stockInfo[]  = $mstockInfo;


}

var_dump ($stockInfo);




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



$sql="SELECT stockname ,price,decide,username,usertel from setstock";
$rows = mysqli_query($conn, $sql);

$dsenddata = array();

while ($dsenddata = mysqli_fetch_assoc($rows))
    $dresult[] = $dsenddata;

//var_dump ($dresult);


for($i=0;$i<count($stockInfo);$i++) {
//https://www.cnblogs.com/tianpan2019/p/11001534.html,根据新浪的第一个名字想等从数据库数据中抽出组成一个新数组
for($j=0;$j<count($dresult);$j++){
if($dresult[$j]['0']=$stockInfo[$i]['0'])
    $m_arr[]=$dresult[$j];
    //var_dump ($m_arr);这里循环的逻辑有问题
}
for($x=0;$x<count($m_arr);++$x){
    //$content='您的股票'.'$m_arr[$x][0]'.'已达到设置价格'.'$m_arr[$x][1]';
    if($m_arr[$x]['decide']=1&&$stockInfo[$i]['1']>=$m_arr[$x]['price']){
    $username=$m_arr[$x]['username'];
        $tel=$m_arr[$x]['usertel'];
        //发送请求并生成记录
        //$sql3 = "update setstock set look='1' WHERE username='$username'";

       // mysqli_query($conn,$sql3);
        $content='发射点犯得';

        $post_data = array(
            'appid' => '21080',
            'to' => $m_arr[$x]['usertel'],
            'content' => $content,
            'signature' => 'eb6e703a46ff308ea98bf44acc7e6234'

        );

        $resdata = send_post('https://api.mysubmail.com/voice/send.json', $post_data);
        $phpdata = json_decode($resdata, true);
       // var_dump ($phpdata);




        if ($phpdata['status'] == "success") {
            $sql5 = "INSERT  INTO alertrecord(alertid,alerttype,username,sendtel,content,recordstate) VALUES('$phpdata[send_id]','股票','$username','$tel','$content','正在发送')";
            $result5 = mysqli_query($conn, $sql5);

            if (!$result5) {
                die('无法插入数据: ' . mysqli_error($conn));
            }
            echo "数据插入成功\n";
            //减去发送的次数
            $sql3 = "update member set resnum=resnum-1  WHERE   DATE_FORMAT(NOW(), '%Y-%m-%d') BETWEEN DATE_FORMAT(startdate, '%Y-%m-%d')  AND DATE_FORMAT(duedate, '%Y-%m-%d') AND username='username'";
            mysqli_query($conn,$sql3);
        }
        else {

            $sql3 = "INSERT  INTO alertrecord(alertid,alerttype,username,sendtel,content,recordstate,msg) VALUES('$phpdata[send_id]','股票''$username','$tel','$content','发送失败','$phpdata[msg]')";
            $result4 = mysqli_query($conn, $sql3);

            if (!$result4) {
                die('无法插入数据: ' . mysqli_error($conn));
            }
            echo "数据插入成功\n";


        }


  }


    else if($m_arr[$x]['decide']=2&&$stockInfo[$i]['1']<=$m_arr[$x]['price']){
        //发送其实是上面一模一样


    }
   } }


?>

