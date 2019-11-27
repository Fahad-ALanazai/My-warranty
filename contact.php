<?php
session_start();
include "conn.php";
$errors = array();
$alert = array();


if(isset($_POST["contact"])){
    $mobile = $_POST["inputPhone"];
    if(empty($mobile)){
        $mobile = null;
    }
    $result = mysqli_query($conn,"INSERT INTO message(M_phone,M_email,tittle,note) VALUES ('$mobile','$_POST[inputEmail]','$_POST[inputTitle]','$_POST[inputMessage]')");
    if($result){
        array_push($alert,"تم الارسال بنجاح");
    }else{
        array_push($errors,mysqli_error($conn));
    }
}
?>
<!doctype html>
<html>

<head>
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
        body {
            background-image: url(background.jpeg);
            background-repeat: no-repeat;
            background-size: cover;
            background-attachment: fixed;
        }

    </style>

</head>

<body class="text-center" dir="rtl">
    <?php include "nav.php";?>

    <?php if(count($alert) > 0){?>
    <div class="alert alert-success">
        <?=$alert[0]?>
    </div>
    <?php } ?>

    <?php if(count($errors) > 0){?>
    <div class="alert alert-danger">
        <?=$errors[0]?>
    </div>
    <?php } ?>

    <form class="form-signin" method="post">
        <img class="mb-4" src="/docs/4.3/assets/brand/bootstrap-solid.svg" alt="" width="72" height="72">
        <h1>تواصل معنا</h1>
        <label> البريد الالكتروني </label>
        <input style="width: 350px;margin: auto" name="inputEmail" type="email" id="inputEmail" class="form-control" placeholder="Email address" required="" autofocus="">
        <label> رقم الجوال </label>
        <input style="width: 350px;margin: auto" name="inputPhone" type="text" id="inputPhone" class="form-control" placeholder="96655555555" autofocus="">
        <label> عنوان الرسالة </label>
        <input style="width: 350px;margin: auto" name="inputTitle" type="text" id="inputTitle" class="form-control" placeholder="عنوان الرساله" required="" autofocus="">
        <label> الرسالة </label>
        <textarea style="width: 350px;margin: auto" name="inputMessage" id="inputMessage" class="form-control" placeholder="الرسالة" required=""></textarea>
        <br>
        <button style="width: 350px;margin: auto" class="btn btn-lg btn-primary btn-block" type="submit" name="contact">تواصل</button>
        <br>

    </form>


</body>

</html>
