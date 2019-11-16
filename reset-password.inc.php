<?php

if(isset($_POST["reset-password-submit"])) {
    $selector = $_POST["selector"];
    $pwd = $_POST["pass1"];
    $pwdRepeat = $_POST["pass2"];

    $currentDate = date("U");

    require "conn.php";

    $sql = "SELECT * FROM change_pass WHERE Recover_code =?";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        echo "There's was an error!";
        exit();
    } else {
        mysqli_stmt_bind_param($stmt, "ss", $selector, $currentDate);
        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);
        if (!$row = mysqli_fetch_assoc($result)) {
            echo "نعتذر لابد ان تعيد طلب استعادة كلمة المرور ";
            exit();
        } else {
                $sql = "select * from users WHERE U_id = ?";
                $stmt = mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($stmt, $sql)) {
                    echo "There's was an error!";
                    exit();
                } else {

                    mysqli_stmt_bind_param($stmt, "i", $_SESSION["tmp_user_id"]);
                    mysqli_stmt_execute($stmt);

                    $result = mysqli_stmt_get_result($stmt);
                    if (!$row = mysqli_fetch_assoc($result)) {
                        echo "نعتذر لابد ان تعيد طلب استعادة كلمة المرور ";
                        exit();
                    } else {


                        $sql = "UPDATE users SET Password=? WHERE U_id=?";


                        $stmt = mysqli_stmt_init($conn);
                        if (!mysqli_stmt_prepare($stmt, $sql)) {
                            echo "There's was an error!";
                            exit();
                        } else {
                            mysqli_stmt_bind_param($stmt, "si", $pwd,$_SESSION["tmp_user_id"]);
                            mysqli_stmt_execute($stmt);


                            $sql = "DELETE FROM change_pass WHERE U_id = ?";
                            $stmt = mysqli_stmt_init($conn);
                            if (!mysqli_stmt_prepare($stmt,$sql)){
                                echo "There's was an error!";
                                exit();
                            }else{
                                mysqli_stmt_bind_param($stmt,"i",$_SESSION["tmp_user_id"]);
                                mysqli_stmt_execute($stmt);
                                header("Location:sign_in.php?alert=تم تحديث كلمة المرور");
                            }

                        }

                    }
                }
            }
        }
}else{
    header("location:index.php");
}

?>