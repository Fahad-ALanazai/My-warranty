<?php
session_start();
include "conn.php";
if(!isset($_SESSION["U_id"])){
    header("location:sign_in.php");
}else {
$id = $_GET["bill"];
$result = mysqli_query($conn, "SELECT * FROM bills WHERE U_ID = " . $_SESSION["U_id"]. " AND B_id = ".$_GET["bill"]);
$row = mysqli_fetch_array($result);
    if(isset($_POST["del"])){
        $id = $_GET["bill"];
        // sql to delete a record
        $sql = "DELETE FROM bills WHERE B_id=$id";

        if (mysqli_query($conn, $sql)) {
            header("location:main.php?alert=تم الحذف بنجاح");
        } else {
            echo "Error deleting record: " . mysqli_error($conn);
        }
    }
if(empty($_GET["bill"]) OR $row == false){
    header("location:main.php");
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>تفاصيل الفاتورة</title>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta name="keywords" content="">
<style>
    td,
    table {
        border: solid;
    }

</style>

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
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
</head>

<body dir="rtl">

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarsExample08" aria-controls="navbarsExample08" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="navbar-collapse justify-content-md-center collapse" id="navbarsExample08">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" href="first.html">ضماناتي</a>
                </li>
                <li>
                    <a class="nav-link active" href="main.php">الصفحة الرئيسية</a>
                </li>
                <li>
                    <a class="nav-link" href="contact.html">تواصل معنا</a>
                </li>
                <li>
                    <a class="nav-link" href="about.html">من نحن</a>
                </li>
                <li>
                    <a class="nav-link active" href="Bill.html">اضافة فاتورة</a>
                </li>

            </ul>
        </div>

    </nav>
    
    
    
    
   <h2>تفاصيل الفواتير</h2>

    <table style="width:100%">
        <input type="hidden" name="B_id" value="<?=$row['B_id']?>">
        <tr>
            <td>اسم الفاتورة</td>
            <td><?= $row["Bill_name"];?></td>
        </tr>
        <tr>
            <td>تاريخ الفاتوره</td>
            <td><?= $row["Bill_date"];?></td>

        </tr>
        <tr>
            <td>مدة الضمان</td>
            <td><?= $row["Warrnty_period"];?></td>

        </tr>
        <tr>
            <td>الشركه المصنعه</td>
            <td><?= $row["Company"];?></td>

        </tr>
        <tr>
            <td>موقع الشراء</td>
            <td><?= $row["Warranty_loc"];?></td>

        </tr>
        <tr>
            <td>صورة الفاتورة</td>
            <td>
                <img src="img/<?= $row['Bill_photo'];?>">
            </td>

        </tr>
    </table>
    <br><br>
    <form action="" method="post">
        <div class="d-inline-block">
            <button name="del" class="btn btn-danger">حذف</button>&nbsp;&nbsp
            <a href="editBill.php?bill=<?=$row['B_id']?>" class="btn btn-primary">
                    تعديل
            </a>&nbsp;&nbsp;
            <button onclick="window.print()" class="btn btn-info">طباعه</button>&nbsp;&nbsp;&nbsp;


            <a href="https://www.google.com.sa/maps/search/<?=$row['Warranty_loc']?>" class="btn btn-secondary">
                 خريطه
            </a>
        </div>
    </form>
</body>

</html>
    <?php
}
?>