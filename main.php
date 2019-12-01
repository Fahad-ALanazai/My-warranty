<?php
    session_start();
    include "conn.php";
    if(!isset($_SESSION["U_id"])){
        header("location:sign_in.php");
    }else {
        $result = mysqli_query($conn, "SELECT * FROM bills WHERE U_ID = " . $_SESSION["U_id"]);
?>
<!DOCTYPE html>
<html>

<head>
    <title> الصفحة الرئيسية </title>
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
    <?php include "nav.php";?>
    <h2>قائمه الفواتير</h2>

    <?php if(isset($_GET["alert"])){?>
    <div class="alert alert-success">
        <?=$_GET['alert'];?>
    </div>
    <?php } ?>

    <?php if(isset($_GET["error"])){?>
    <div class="alert alert-danger">
        <?=$_GET['error'];?>
    </div>
    <?php } ?>
    <table style="width:100%">
        <tr>
            <td>اسم الفاتورة</td>
            <td>تاريخ الفاتورة</td>
            <td>التفاصيل</td>
        </tr>

        <?php
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    ?>
        <tr>
            <td>
                <?= $row["Bill_name"]; ?>
            </td>
            <td>
                <?= $row["Bill_date"]; ?>
            </td>
            <td>
                <a href="detail.php?bill=<?= $row["B_id"]; ?>">التفاصيل</a>
            </td>
        </tr>

        <?php
                }
            }
                ?>
    </table>
    <br>
    <br>
    <a href="Bill.php">
        <button class="btn btn-primary">اضافه فاتورة</button>
    </a>

</body>

</html>
<?php
    }
    ?>
