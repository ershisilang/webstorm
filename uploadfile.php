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