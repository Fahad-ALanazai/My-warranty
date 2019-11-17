<?php
session_start();
include "conn.php";
$errors = array();

if(isset($_POST["reset"])){
    $result = mysqli_query($conn,"SELECT * FROM users WHERE Email = '$_POST[inputEmail]'");

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
</head>

<body class="text-center" dir="rtl">
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarsExample08" aria-controls="navbarsExample08" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <?php include "nav.php";?>
</nav>

<?php if(count($errors) > 0){?>
    <div class="alert alert-danger">
        <ul>
            <?php
            foreach ($errors as $error){
                echo "<li>".$error."</li>";
            }
            ?>
        </ul>
    </div>
<?php }?>

<?php
if(isset($_GET['reset'])){
    if(isset($_GET['reset']) == "success"){
        echo "<p>تم ارسال البريد الالكتروني الرجاء التحقق من جميع الصناديق</p>";
    }
}
if(isset($_GET['q'])){
    if(isset($_GET['q']) == "notFound"){
        echo "<p>الرجاء التحقق مجدداُ لايوجد سجل بهذا العنوان</p>";
    }
}

if(isset($_GET['alert'])){
?>
    <div class="alert alert-danger">
        <?= $_GET['alert'];?>
    </div>
<?php }?>
<form class="form-signin" method="post" action="reset-request.inc.php">
    <img class="mb-4" src="/docs/4.3/assets/brand/bootstrap-solid.svg" alt="" width="72" height="72">
    <h1>استعادة كلمة المرور </h1>
    <label> البريد الالكتروني </label>
    <input style="width: 350px;margin: auto" name="inputEmail" type="email" id="inputEmail" class="form-control" placeholder="Email address" required="" autofocus="">
    <br>
    <button style="width: 350px;margin: auto" class="btn btn-lg btn-primary btn-block" type="submit" name="reset">استعادة</button>
    <br>

</form>


</body>

</html>
