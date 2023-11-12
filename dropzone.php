<?php
    include_once 'inc/functions.php';
    $uploadDir = 'uploads';  
    $allowed_ext=['jpg','JPG','jpeg','JPEG','png','PNG','pdf','PDF','doc','DOC','docx','DOCX'];
if (!empty($_FILES)) {  
    $file_name=$_FILES['file']['name'];
    $user_id=$_REQUEST['user_id'];
    $arr=explode('.',$file_name);
    $ext=end($arr);
    if(in_array($ext,$allowed_ext)){
         $tmpFile = $_FILES['file']['tmp_name'];
         $new_file_name=time().'-'.md5(rand(11111,99999)).".".$ext;
         $filename = $uploadDir.'/'.$new_file_name;
       if(  move_uploaded_file($tmpFile,$filename)){
          $q=mysqli_query($dbc,"INSERT INTO attachments(file_name,user_id) VALUES('$new_file_name','$user_id')");
          if(!$q){
              echo mysqli_error($dbc);
          }
       }
    }
}  
    
?>