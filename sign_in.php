<?php
session_start();
include "conn.php";
$errors = array();

if(isset($_POST["singin"])){
    $result = mysqli_query($conn,"SELECT * FROM users WHERE Email = '$_POST[inputEmail]' AND Password = '$_POST[inputPassword]'");
    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            $_SESSION['U_id'] = $row['U_id'];
            if($row["User_type"] == 0){
                header("Location:admin.php");
            }
        }
        header("Location:main.php");
    }else{
        array_push($errors,"خطا في البريد الالكتروني او كلمة المرور");
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
</head>

<body class="text-center" dir="rtl">
<?php include "nav.php";?>

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
    if(isset($_GET["alert"])){?>
    <div class="alert alert-success">
        <?=$_GET["alert"];?>
    </div>
    <?php
    }
    ?>

    <form class="form-signin" method="post">
        <img class="mb-4" src="/docs/4.3/assets/brand/bootstrap-solid.svg" alt="" width="72" height="72">
        <h1>تسجيل الدخول </h1>
        <label> البريد الالكتروني </label>
        <input style="width: 350px;margin: auto" name="inputEmail" type="email" id="inputEmail" class="form-control" placeholder="Email address" required="" autofocus="">
        <label> كلمة المرور </label>
        <input style="width: 350px;margin: auto" name="inputPassword" type="password" id="inputPassword" class="form-control" placeholder="Password" required="">
        <br>
        <button style="width: 350px;margin: auto" class="btn btn-lg btn-primary btn-block" type="submit" name="singin">Sign in</button>
<br>
        <label><a href="forget.php">هل نسيت كلمة المرور؟</a></label>

    </form>


</body>

</html>
