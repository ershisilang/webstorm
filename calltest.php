<?php
require "./qcloudsms_php/src/index.php";


use Qcloud\Sms\FileVoiceSender;

$appid =1400166420; // 1400开头
// 短信应用SDK AppKey
$appkey = "e4bed6323edb904de137ccb172a484be";
// 需要发送短信的手机号码
$phoneNumbers = ["13880478475", "15114097143"];

// 定义变量并默认设置为空值

        try {
            $fid = "9f1f5a8c13c3ed39a5085c4ca1d286b8f30efeb6.wav";
            $fvsender = new FileVoiceSender($appid, $appkey);
            $result = $fvsender->send("86", $phoneNumbers[0], $fid);
            $rsp = json_decode($result);
            echo $result;
        } catch (\Exception $e) {
            echo var_dump($e);
        }
        echo "\n";






?>