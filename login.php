
<?php

$username=$_POST['login_tel'];
$password=$_POST['login_pas'];



$errmsg = '';

if (!empty($username)) { // 用户填写了数据才执行数据库操作

//---------------------------------------------------------

// 数据验证, empty()函数判断变量内容是否为空

if (empty($username)) {

$errmsg = '数据输入不完整';

}



if(empty($errmsg)) { // $errmsg为空说明前面的验证通过

// 调用mysqli的构造函数建立连接，同时选择使用数据库'test'

$db = @new mysqli("127.0.0.1", "developer", "123456", "test");

// 检查数据库连接

if (mysqli_connect_errno()) {

$errmsg = "数据库连接失败!

\n";

}

else {

// 查询数据库，看用户名及密码是否正确

$sql = "SELECT * FROM user WHERE username='$username' AND password='$password'";

$rs = $db->query($sql);

// $rs->num_rows判断上面的执行结果是否含有记录，有记录说明登录成功 if ($rs && $rs->num_rows > 0) {

// 在实际应用中可以使用前面提到的重定向功能转到主页

$errmsg = "登录成功!";

}

else {

$errmsg = "用户名或密码不正确，登录失败!";

}



// 关闭数据库连接

$db->close();

}

}

}

?>
