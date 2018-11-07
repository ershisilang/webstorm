
<?php 

$postInfo = http_build_query(
    array(
        "ext" => " ",
        "playtimes" => "2"
         "promptfile" => " 语音内容文本",
        "prompttype" => "2"
        "sig" => "{
                    "mobile": "13788888888",
                     "nationcode": "86" "
        "time" => "1457336869"
      
    )
);

$options = array("http" =>
    array(
        "method"  => "POST",
        "header"  => "Content-type: application/x-www-form-urlencoded",
        "content" => $postInfo
    )
);

$context = stream_context_create($options);
$url = 'https://cloud.tim.qq.com/v5/tlsvoicesvr/sendvoiceprompt?sdkappid={sdkappid}&random={random}'
$text = file_get_contents($url, false, $context);
echo $text;

$t = json_decode($text, true)
        
//connect to the database   
$conn=mysql_connect($mysql_server_name,$mysql_username,$mysql_password) or die("error connecting") ; //连接数据库
mysql_query("set names 'utf8'"); //数据库输出编码 应该与你的数据库编码保持一致.南昌网站建设公司百恒网络PHP工程师建议用UTF-8 国际标准编码.
mysql_select_db($mysql_database); //打开数据库
$sql ="select * from news "; //SQL语句
$result = mysql_query($sql,$conn); //查询


?> 