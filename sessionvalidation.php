<?php
//  防止全局变量造成安全隐患
session_destroy();
if (!isset($_SESSION['name'])){
    echo "未登陆";
} else {
    echo "已登陆";

}
?>