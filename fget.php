<?php
if(empty($_GET["Recover_code"])){
    header("location:forget.php?alert=الرجاء التاكد من التحقق");
}else {
    ?>
    <!DOCTYPE html>
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
        <link href="/docs/4.3/dist/css/bootstrap.min.css" rel="stylesheet"
              integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
              crossorigin="anonymous">
        <!-- Custom styles for this template -->
        <link href="signin.css" rel="stylesheet">
        <link href="navbar.css" rel="stylesheet">
    </head>

    <body class="text-center" dir="rtl">
    <?php include "nav.php";?>

    <h1>مرحبا بك</h1>
    <form action="reset-password.inc.php" method="POST">
        <input type="hidden" name="selector" value="<?=$_GET["Recover_code"];?>">
        <label>كلمة المرور الجديدة</label>
        &nbsp;&nbsp;
        <input type="text" id="pass1" name="pass1">
        <br><br>
        <label>إعادة كلمة المرور</label>
        &nbsp;&nbsp;
        <input type="text" id="pass2" name="pass2">
        <br><br>
        <button>اعادة تعيين</button>
    </form>
    </body>

    </html>
    <?php
}?>