//把校验的php放到html里面

<html>
<head>
<meta charset="utf-8">
<title>菜鸟教程(runoob.com)</title>
<style>
.error {color: #FF0000;}
</style>
</head>
<body> 

<?php
// 定义变量并默认设置为空值
$nameErr = $emailErr = $genderErr = $websiteErr = "";
$name = $email = $gender = $comment = $website = "";

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    if (empty($_POST["name"]))
    {
        $nameErr = "名字是必需的";
    }
    else
    {
        $name = test_input($_POST["name"]);
        // 检测名字是否只包含字母跟空格
        if (!preg_match("/^[a-zA-Z ]*$/",$name))
        {
            $nameErr = "只允许字母和空格"; 
        }
    }
    
    if (empty($_POST["email"]))
    {
      $emailErr = "邮箱是必需的";
    }
    else
    {
        $email = test_input($_POST["email"]);
        // 检测邮箱是否合法
        if (!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/",$email))
        {
            $emailErr = "非法邮箱格式"; 
        }
    }
    
    if (empty($_POST["website"]))
    {
        $website = "";
    }
    else
    {
        $website = test_input($_POST["website"]);
        // 检测 URL 地址是否合法
        if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$website))
        {
            $websiteErr = "非法的 URL 的地址"; 
        }
    }
    
    if (empty($_POST["comment"]))
    {
        $comment = "";
    }
    else
    {
        $comment = test_input($_POST["comment"]);
    }
    
    if (empty($_POST["gender"]))
    {
        $genderErr = "性别是必需的";
    }
    else
    {
        $gender = test_input($_POST["gender"]);
    }
}

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>

<h2>PHP 表单验证实例</h2>
<p><span class="error">* 必需字段。</span></p>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"> 
   名字: <input type="text" name="name" value="<?php echo $name;?>">
   <span class="error">* <?php echo $nameErr;?></span>
   <br><br>
   E-mail: <input type="text" name="email" value="<?php echo $email;?>">
   <span class="error">* <?php echo $emailErr;?></span>
   <br><br>
   网址: <input type="text" name="website" value="<?php echo $website;?>">
   <span class="error"><?php echo $websiteErr;?></span>
   <br><br>
   备注: <textarea name="comment" rows="5" cols="40"><?php echo $comment;?></textarea>
   <br><br>
   性别:
   <input type="radio" name="gender" <?php if (isset($gender) && $gender=="female") echo "checked";?>  value="female">女
   <input type="radio" name="gender" <?php if (isset($gender) && $gender=="male") echo "checked";?>  value="male">男
   <span class="error">* <?php echo $genderErr;?></span>
   <br><br>
   <input type="submit" name="submit" value="Submit"> 
</form>

<?php
echo "<h2>您输入的内容是:</h2>";
echo $name;
echo "<br>";
echo $email;
echo "<br>";
echo $website;
echo "<br>";
echo $comment;
echo "<br>";
echo $gender;
?>

</body>
</html>



//先正则校验输入框是否符合格式
<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["name"])) {
    $nameErr = "Name is required";
  } else {
    $name = test_input($_POST["name"]);
    // 检查名字是否包含字母和空格
    if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
      $nameErr = "Only letters and white space allowed"; 
    }
  }

  if (empty($_POST["email"])) {
    $emailErr = "Email is required";
  } else {
    $email = test_input($_POST["email"]);
    // 检查电邮地址语法是否有效
    if (!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/",$email)) {
      $emailErr = "Invalid email format"; 
    }
  }

  if (empty($_POST["website"])) {
    $website = "";
  } else {
    $website = test_input($_POST["website"]);
    // 检查 URL 地址语言是否有效（此正则表达式同样允许 URL 中的下划线）
    if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%
    =~_|]/i",$website)) {
      $websiteErr = "Invalid URL"; 
    }
  }

  if (empty($_POST["comment"])) {
    $comment = "";
  } else {
    $comment = test_input($_POST["comment"]);
  }

  if (empty($_POST["gender"])) {
    $genderErr = "Gender is required";
  } else {
    $gender = test_input($_POST["gender"]);
  }
}




//将文件存到服务器
    $currentDir = getcwd();
    $uploadDirectory = "/uploads/";
    $errors = []; // Store all foreseen and unforseen errors here
    $fileExtensions = ['mpeg','wav']; // Get all the file extensions
    $fileName = $_FILES['myfile']['name'];
    $fileSize = $_FILES['myfile']['size'];
    $fileTmpName  = $_FILES['myfile']['tmp_name'];
    $fileType = $_FILES['myfile']['type'];
    $fileExtension = strtolower(end(explode('.',$fileName)));

    $uploadPath = $currentDir . $uploadDirectory . basename($fileName); 

    if (isset($_POST['submit'])) {

        if (! in_array($fileExtension,$fileExtensions)) {
            $errors[] = "This file extension is not allowed. Please upload a JPEG or PNG file";
        }

        if ($fileSize > 390625) {
            $errors[] = "This file is more than 400k. Sorry, it has to be less than or equal to 2MB";
        }

        if (empty($errors)) {
            $didUpload = move_uploaded_file($fileTmpName, $uploadPath);

            if ($didUpload) {
                echo "The file " . basename($fileName) . " has been uploaded";
            } else {
                echo "An error occurred somewhere. Try again or contact the admin";
            }
        } else {
            foreach ($errors as $error) {
                echo $error . "These are the errors" . "\n";
            }
        }
    }
?>

//将文件插入数据库
<?php

if (isset($_POST['submit'])) {
$con = mysql_connect("IP","name","password");

if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }
mysql_select_db("my_db", $con);//更改为当前数据库
$sql="INSERT INTO person (Id, Name, Num)//更改为当前的数据库的值
VALUES
('$_POST[id]','$_POST[tel]','$_POST[pname]',$_POST[aname]','$uploadDirectory','$_POST[date],$_POST[user_date]')";
mysqli_query($my_db, $sql);
if (!mysql_query($sql,$con))
  {
  die('Error: ' . mysql_error());
  }
";
mysql_close($con);    
}
?>
 


第一种php直接上传表单的方案疑问是如何修改样式

<html>
<body>
<form action="uploadaction.php" method="post">
发送电话: <input type="text" name="tel"><br>
接受人名字: <input type="text" name="pname"><br>
语音文件名: <input type="text" name="aname"><br>
上传语音文件:<input type="file" name="myfile" id="fileToUpload">
是否重复;<input type="radio" name="repeat" value="is" /> 是<input type="radio" name="date" value="isnot" /> 否<br />
选择重复周期:<input type="checkbox" name="date" value="monday" /> 星期一
<input type="checkbox" name="date" value="tuesday" /> 星期二
<input type="checkbox" name="date" value="wednesday" /> 星期三
<input type="checkbox" name="date" value="thursday" /> 星期四
<input type="checkbox" name="date" value="friday" /> 星期五
<input type="checkbox" name="date" value="saturday" /> 星期六
<input type="checkbox" name="date" value="sunday" /> 星期天
选择日期: <input type="date" name="user_date" />
选择时间: <input type="time" name="user_time" />
<input type="submit" />
</form>
</body>
</html>

//参考文件
<?php
$arr = $_FILES["file"];

if(($arr["type"]=="mpeg/wav" || $arr["type"]=="mpeg/wav" ) && $arr["size"]<3906250)
{
$arr["tmp_name"];

$filename = "./alert/".date('YmdHis').$arr["name"];//保存文件的位置，暂时修改为本地

  if(file_exists($filename))
  {
    echo "该文件已存在";
  }
  else
  {
 
  $filename = iconv("UTF-8","gb2312",$filename);
   move_uploaded_file($arr["tmp_name"],$filename);
  }
}
else
{
  echo "请上传小于400k，格式为mp3或wav的语音文件";
<?php 

//in_array来校验；explode字符串打散为数组，才能进行数组校验;给文件一个唯一的id

 $file = $_FILES['file'];
 $filename = $_FILES['file']['name'];
 $fileSize = $_FILES['file']['size'];
 $fileType = $_FILES['file']['type'];
 $fileTmp_Name = $_FILES['file']['tmp_name'];
 $fileError = $_FILES['file']['error'];
 
 $filExt = explode('.',$fileName);
 $fileActualExt = strtolow9(end($fileExt));
 $allowed = array ('mp3','wav','mpeg');
 

 
 
 if(in_array($fileActualExt,$allowed)){
     if($fileError === 0){
         if($fileSize>399) {
             $fileNameNew = uniqid('',true).".".$fileActualExt;
             $FileDestination = 'uploads/'.$fileName;
             move_uploaded_file($fileTmp_Name, $FileDestination);
             header("Loction; index.php?uploadsuccess");
         }  
         else{
             echo  " Your file is too big ()400
              ";
                      }
                       }
 else {
     echo "there is an error uploading your file";
 }
 }
 else {
     echo "you cannot upload files of this type!";
}




?> 

<form action="uploadfile.php" method="post"
enctype="multipart/form-data">
<label for="file">Filename:</label>
<input type="file" name="file" id="file" /> 
<br />
<input type="submit" name="submit" value="上传" />
</form>