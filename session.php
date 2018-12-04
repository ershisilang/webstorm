<?php

session_start();
unset($_SESSION["name"]);
/*if(!isset($_SESSION['name']) )
   {
       die('无法插入数据' );
   }
   echo "数据插入成功\n";
*/
header("Location: index.html");
?>






