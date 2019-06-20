<?php
header("Content-Type:text/html;charset=gb2312");
header("Access-Control-Allow-Origin: http://hq.sinajs.cn/");
$stockInfoString = file_get_contents("http://hq.sinajs.cn/list=sh000001");

$result=explode(",",$stockInfoString);//将返回的字符串根据逗号分割为字符串
$stockInfo=array();
//最终输出的，包含股票信息的数组

// 根据正则表达式提取股票名称
  $name=$result[0]."\"";
  $name=preg_match_all('/\"(.*?)\"/', $name, $matches);
    $name=str_replace("\"","",$matches[0][0]);

    // 根据正则提取股票代码（包含sz/sh）
    if (preg_match("/sz/", $result[0])) {
        $result[0]=preg_replace('/\D/s', '', $result[0]);
        $code="sz".$result[0];
    }
    else if (preg_match("/sh/", $result[0])) {
        $result[0]=preg_replace('/\D/s', '', $result[0]);
        $code="sh".$result[0];
    }

    $stockInfo[0]=$name;//股票名称
    $stockInfo[1]=$code;//股票代码

    for ($i=2; $i < count($result); $i++) { //将其他信息赋给最终输出的数组
        $stockInfo[$i]=$result[$i-1];
    }

    $out="";
   	for ($i=0; $i < count($stockInfo); $i++) { //输出
        $out=$out.$stockInfo[$i]."#";
    }
    echo $out;
 ?>
