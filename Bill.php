<?php
session_start();
include "conn.php";
if(!isset($_SESSION["U_id"])){
    header("location:sign_in.php");
}else {
    if(isset($_POST["save"])){
        $target_dir = "img/";
        $fileName = $_FILES["fileToUpload"]["name"];
        $fileTmpName  = $_FILES['fileToUpload']['tmp_name'];
        $tempPic = explode('.',$fileName);
        $fileExtension = end($tempPic);
        $uploadPath = $target_dir.basename($fileName);
        $uploadOk = 1;

        if($fileExtension != "jpg" && $fileExtension != "png" && $fileExtension != "jpeg"
            && $fileExtension != "gif" ) {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }
        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $uploadPath)) {
                echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
            } else {
                die("ERORRRRR");
                echo "Sorry, there was an error uploading your file.";
            }
        }
        $user_id = $_SESSION['U_id'];
        $s = mysqli_query($conn,"INSERT INTO bills(Bill_name,Bill_date,Warrnty_period,Company,Warranty_loc,Bill_photo,U_id) VALUES('$_POST[name]','$_POST[date]','$_POST[time]','$_POST[comp]','$_POST[loc]','$fileName',$user_id)");
        if($s){
           header("location:main.php");
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
        <title>
    إضافة فاتورة
    </title>

<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v3.8.5">

    <link rel="canonical" href="https://getbootstrap.com/docs/4.3/examples/sign-in/">
    <link rel="stylesheet" href="bootstrap-rtl.min.css">
    <link rel="stylesheet" href="bootstrap.min.css">

    <!-- Bootstrap core CSS -->
    <link href="/docs/4.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <!-- Custom styles for this template -->
    <link href="signin.css" rel="stylesheet">
    <link href="navbar.css" rel="stylesheet">
    <style>
    
        form{
            text-align: right
        }
        input {
            text-align: center
                
        }
    </style>
</head>
<?php include "nav.php";?>
    
    <br><br>
 <form dir="rtl" method="post" enctype="multipart/form-data">
     <ul>
 اسم الفاتوره:
    <input type="text" name="name" id="name" required>
        <br>
        <br>
     
     
     
      
   تاريخ الفاتوره:
    <input type="date" name="date" id="date" required>
        <br>
    
        <br>
     
     
   مدة الضمان:
    <input type="date" name="time" id="time" required>
        <br>
     
     
        <br>
     
     
  الشركة المصنعه:
    <input type="text" name="comp" id="comp" required>
        <br>
        <br>
     
    موقع الشراء
      <input type="text" name="loc" id="loc" required>
        <br>
         <br>
         
         
          صورة الفاتورة:
         
      <input type="file" name="fileToUpload" required>
        <br>
         <br>

         <button name="save" value="save">حـفظ</button>
     </ul>
    </form>
</body>
</html>
