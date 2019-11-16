<?php
session_start();
include "conn.php";
if(!isset($_SESSION["U_id"])){
    header("location:sign_in.php");
}else {
    if (!isset($_GET["bill"])) {
        header("location:main.php");
    } else {
        $id = $_GET['bill'];
        $user_id = $_SESSION["U_id"];
        $result = mysqli_query($conn, "SELECT * FROM bills WHERE U_ID = " . $_SESSION["U_id"]. " AND B_id = ".$_GET["bill"]);
        $row = mysqli_fetch_array($result);

        if (isset($_POST["update"])) {
            if(empty($_FILES["fileToUpload"])){
                $sql = "UPDATE bills SET Bill_name = '$_POST[name]',Bill_date = '$_POST[date]',Warrnty_period = '$_POST[time]',Company = '$_POST[comp]',Warranty_loc = '$_POST[loc]' WHERE B_id = $id";
                if(mysqli_query($conn,$sql)){
                    header("location:main.php?alert=تم تحديث الفاتورة بنجاح");
                }
            }else{
            $target_dir = "img/";
            $fileName = $_FILES["fileToUpload"]["name"];
            $fileTmpName = $_FILES['fileToUpload']['tmp_name'];
            $tempPic = explode('.', $fileName);
            $fileExtension = end($tempPic);
            $uploadPath = $target_dir . basename($fileName);
            $uploadOk = 1;

            if ($fileExtension != "jpg" && $fileExtension != "png" && $fileExtension != "jpeg"
                && $fileExtension != "gif") {
                echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                $uploadOk = 0;
            }
            // Check if $uploadOk is set to 0 by an error
            if ($uploadOk == 0) {
                echo "Sorry, your file was not uploaded.";
                // if everything is ok, try to upload file
            } else {
                if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $uploadPath)) {
                    $sql = "UPDATE bills SET Bill_name = '$_POST[name]',Bill_date = '$_POST[date]',Warrnty_period = '$_POST[time]',Company = '$_POST[comp]',Warranty_loc = '$_POST[loc]',Bill_photo = '$fileName' WHERE B_id = $id";
                    if(mysqli_query($conn,$sql)){
                        header("location:main.php?alert=تم تحديث الفاتورة مع صورة بنجاح");
                    }
                } else {
                    echo "Sorry, there was an error uploading your file.";
                }
            }
        }
    }

        ?>

        <!DOCTYPE html>
        <html>
        <head>
            <title>
                تعديل فاتورة
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
            <link href="/docs/4.3/dist/css/bootstrap.min.css" rel="stylesheet"
                  integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
                  crossorigin="anonymous">
            <!-- Custom styles for this template -->
            <link href="signin.css" rel="stylesheet">
            <link href="navbar.css" rel="stylesheet">
            <style>

                form {
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
                <input type="text" name="name" id="name" required value="<?=$row['Bill_name'];?>">
                <br>
                <br>


                تاريخ الفاتوره:
                <input type="date" name="date" id="date" required value="<?=$row['Bill_date'];?>">
                <br>

                <br>


                مدة الضمان:
                <input type="date" name="time" id="time" required value="<?=$row['Warrnty_period'];?>">
                <br>


                <br>


                الشركة المصنعه:
                <input type="text" name="comp" id="comp" required value="<?=$row['Company'];?>" >
                <br>
                <br>

                موقع الشراء
                <input type="text" name="loc" id="loc" required value="<?=$row['Warranty_loc'];?>">
                <br>
                <br>


                صورة الفاتورة:

                <input type="file" name="fileToUpload">
                <br>
                <br>

                <button name="update" value="update">تحديث</button>
            </ul>
        </form>
        </body>
        </html>
        <?php
    }
}
    ?>