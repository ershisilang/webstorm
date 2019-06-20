<?php
//股票接收的数组
global $recestoc;


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

$sql="SELECT stockname ,price,decide,username,usertel from setstock";
$rows = mysqli_query($conn, $sql);

$senddata = array();

while ($senddata = mysqli_fetch_assoc($rows))
    $result[] = $senddata;


/*
var_dump ($result);
if(is_array($result)){
    echo '变量 $arr_site 是一个数组';
} else {
    echo '变量 $arr_site 不是一个数组';
}
*/

for($i=0;$i<count($recestoc);++$i) {

    function myfunc($arr){        //定义过滤函数
        $j=count($arr);
        for($x=0;$x<$j;$x++){
            if($arr[$x]['0']=$recestoc[$i]['0'])
                $n_arr[]=$arr[$i];
        }
        return $n_arr;
    }


    $newarr=myfunc($result);        //调用函数并使用变量接收函数的返回值
    echo '<br />过滤出来的新数组信息：<br />';
    print_r($newarr);        //输出新数组的信息







}



?>
