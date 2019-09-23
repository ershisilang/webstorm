<?php

require 'vendor/autoload.php';
use QL\QueryList;


$data = QueryList::get('http://quote.eastmoney.com/stocklist.html')->find('a')->texts();
print_r($data->all());

//content这个变量undifined
preg_match_all('/{(.*?)}/', $content, $matches);
//print_r(array_map('intval',$matches[1]));


//使用正则提取括号内容，使用str提取括号内内容


?>