<?php

if(isset($_POST['reset'])){
    // Create tokens
    $selector = bin2hex(random_bytes(10));
    //$token = random_bytes(32);

    //url
    $url = "http://localhost/fget.php?Recover_code=".$selector;

    // token expired!
    $expires = date("U")+1800;
    // create a connection !
    require "conn.php";
    // get information
    $inputEmail = $_POST["inputEmail"];
    $s = mysqli_query($conn,"SELECT * FROM users WHERE Email = '$inputEmail'");
    $f = mysqli_fetch_array($s);
    $user_id = $f["U_id"];
    session_start();
    $_SESSION["tmp_user_id"] = $user_id;

    // check if the user have already token and delete it to not have a multiple tokens!

    $sql = "DELETE FROM change_pass WHERE U_id=?";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt,$sql)){
        echo "لم يتم الحذف يوجد خطا";
        exit();
    }else{
        mysqli_stmt_bind_param($stmt,"s",$user_id);
        mysqli_stmt_execute($stmt);
    }
    $result = mysqli_query($conn, "SELECT * FROM users WHERE U_id= $user_id");
    if (mysqli_num_rows($result) > 0) {
        $sql = "INSERT INTO change_pass(Recover_code,U_id) VALUES(?,?)";
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            echo "هنالك خطا";
            exit();
        } else {
            mysqli_stmt_bind_param($stmt, "si",$selector,$user_id);
            mysqli_stmt_execute($stmt);
        }
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
        $to = $inputEmail;
        $subject = "استعد كلمة المرو";
        $message = "<p dir='rtl'>لقد استلمنا طلبك لستعادة كلمة المرور الخاصة بك! اذا لم تقدم هذا الطلب الرجاء تجاهل هذة الرسالة</p>";
        $message .= "<p dir='rtl'>رابط استعادة كلمة المرور</p></br>";
        $message .= "<a href='" . $url . "'>" . $url . "</a>";

        $headers = "From: Support <support@My-Warranty.com>\r\n";
        $headers .= "Content-type:text/html\r\n";

        mail($to, $subject, $message, $headers);
        header("location:forget.php?reset=success");
    }else{
        header("location:forget.php?q=notFound");
    }
}else{
    header("Location:first.html");
}

?>