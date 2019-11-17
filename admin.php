<?php
session_start();
include "conn.php";
if(!isset($_SESSION["U_id"])){
    header("location:sign_in.php");
}else {
    function is_admin($conn,$id){
        $sql = mysqli_query($conn,"SELECT * FROM users WHERE U_id = $id AND User_type = 0");
        $result = mysqli_fetch_array($sql);
        if (count($result) > 0) {
            return true;
        }else{
            return false;
        }
    }
    if(!is_admin($conn,$_SESSION["U_id"])){
        header("location:main.php?error=لايوجد لديك تصريح");
    }
    $result = mysqli_query($conn, "SELECT * FROM message");
    ?>
    <!DOCTYPE html>
    <html>

    <head>
        <title> صفحة الادارة </title>
        <meta charset="UTF-8">
        <meta name="description" content="">
        <meta name="keywords" content="">

        <style>
            td, table {
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
        <link href="/docs/4.3/dist/css/bootstrap.min.css" rel="stylesheet"
              integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
              crossorigin="anonymous">
        <!-- Custom styles for this template -->
        <link href="signin.css" rel="stylesheet">
        <link href="navbar.css" rel="stylesheet">
    </head>

    <body dir="rtl">

    <?php include "nav.php";?>
    <h2>قائمه الرسائل</h2>
    <table style="width:100%">
        <tr>
            <td>ايميل المرسل</td>
            <td>رقم جوال المرسل</td>
            <td>عنوان الرسالة</td>
            <td>محتوى الرسالة</td>
            <td>تاريخ الرسالة</td>

        </tr>

        <?php
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                ?>
                <tr>
                    <td>
                        <?= $row["M_email"]; ?>
                    </td>
                    <td>
                        <?php
                            if(empty($row["M_phone"])){
                                echo "لايوجد رقم جوال";
                            }else{
                                echo $row["M_phone"];
                            }
                            ?>
                    </td>
                    <td>
                        <?= $row["tittle"]; ?>
                    </td>
                    <td>
                        <?=$row["note"];?>
                    </td>
                    <td>
                        <?=$row["date"];?>
                    </td>
                </tr>

                <?php
            }
        }
        ?>
    </table>
    </body>
    </html>
    <?php
}
?>