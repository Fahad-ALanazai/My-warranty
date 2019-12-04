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
                //echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
            } else {
                die("ERORRRRR");
                echo "Sorry, there was an error uploading your file.";
            }
        }
        $date = new DateTime($_POST["date"]);
        $date_time = (int) $_POST["time"];
        $date_type = $_POST["time_type"];
        if($date_type == "month"){
            $date->modify("+$date_time months");
            $date = $date->format("Y/m/d");
        }elseif ($date_type == "year") {
            $date->modify("+$date_time years");
            $date = $date->format("Y/m/d");
        }
        $user_id = $_SESSION['U_id'];
        $s = mysqli_query($conn,"INSERT INTO bills(Bill_name,Bill_date,Warrnty_period,Company,Warranty_loc,Bill_photo,U_id) VALUES('$_POST[name]','$_POST[date]','$date','$_POST[comp]','$_POST[loc]','$fileName',$user_id)");
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

    <script>
    function myMap() {
        var center = new google.maps.LatLng(26.344567582855507, 43.950184727508486);
        var mapProp= {
        center:center,
        zoom:17,
        mapTypeId: 'satellite'
        };

        var map = new google.maps.Map(document.getElementById("googleMap"),mapProp);
        var image = 'img/marker.png';
        var marker = new google.maps.Marker({
                position: center,
                animation:google.maps.Animation.BOUNCE,
            });
        marker.setMap(map);
        google.maps.event.addListener(map,'click',function(event) {
        marker.setPosition(event.latLng);
        document.getElementById("loc").value = event.latLng;
        });
    }

    </script>

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
    <div class="container">
    <br><br>
 <form dir="rtl" method="post" enctype="multipart/form-data">
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="name">اسم الفاتوره:</label>
            <input type="text" class="form-control" name="name" id="name" required>
        </div>
        <div class="form-group col-md-6">
            <label for="date">تاريخ الفاتوره:</label>
            <input type="date" class="form-control" name="date" id="date" required>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-4">
            <label for="time">مدة الضمان:</label>
            <div class="row">
                <div class="col-md-4">
                    <select class="custom-select mr-sm-0" name="time" id="time">
                        <option value="1" selected>1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                        <option value="7">7</option>
                        <option value="8">8</option>
                        <option value="9">9</option>
                        <option value="10">10</option>
                        <option value="11">11</option>
                        <option value="12">12</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <select class="custom-select mr-sm-0" name="time_type" id="time_type">
                        <option value="month" selected>شهر</option>
                        <option value="year">سنة</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="form-group col-md-4">
            <label for="comp">الشركة المصنعه:</label>
            <input type="text" class="form-control" name="comp" id="comp" required>
        </div>

        <div class="form-group col-md-4">
            <label for="file">صورة الفاتورة:</label>
            <input type="file" class="form-control-file" name="fileToUpload" required>
        </div>
    </div>

    <div class="form-row form-group">
        <label for="loc">موقع الشراء</label>
        <input type="hidden" name="loc" id="loc" value="(26.344567582855507, 43.950184727508486)">
        <div id="googleMap" style="width:100%; height: 400px;"></div>
    </div>
    
         <button name="save" class="btn btn-primary" value="save">حـفظ</button>

    </div>
    </form>
    </div>
    <script src="https://maps.googleapis.com/maps/api/js?callback=myMap"></script>
    <script>
    document.getElementById('date').valueAsDate = new Date();
    </script>
</body>
</html>
