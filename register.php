<?php
session_start();
include "conn.php";
$errors = array();

if(isset($_POST["register"])){
    $password = md5($_POST['inputPassword']);
    $sql = "INSERT INTO users(U_name,U_phone,Email,Password) VALUES('$_POST[inputName]','$_POST[inputPhone]','$_POST[inputEmail]','$password')";

    if(mysqli_query($conn,$sql)){
    $last_id = mysqli_insert_id($conn);
    $_SESSION['U_id'] = $last_id;
    header("location:main.php");

    }else{
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
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
    <form class="form-signin" method="post">
        <img class="mb-4" src="/docs/4.3/assets/brand/bootstrap-solid.svg" alt="" width="72" height="72">
        <h1>التسجيل</h1>
        <label> اسم المستخدم </label>
        <input style="width: 350px;margin: auto" name="inputName" type="text" id="inputName" class="form-control" placeholder="محمد" required="" autofocus="">

        <label>رقم الجوال </label>
        <input style="width: 350px;margin: auto" name="inputPhone" type="text" id="inputPhone" class="form-control" placeholder="96655555555" required="" autofocus="">

        <label> البريد الالكتروني </label>
        <input style="width: 350px;margin: auto" name="inputEmail" type="email" id="inputEmail" class="form-control" placeholder="Email address" required="" autofocus="">
        <label> كلمة المرور </label>
        <input style="width: 350px;margin: auto" name="inputPassword" type="password" id="inputPassword" class="form-control" placeholder="Password" required="">
        <br>
        <button style="width: 350px;margin: auto" class="btn btn-lg btn-primary btn-block" type="submit" name="register">تسجيل</button>
<br>
        <label><a href="fget.php">هل نسيت كلمة المرور؟</a></label>

    </form>


</body>

</html>
