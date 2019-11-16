<?php

function is_admin($conn,$id){
    $sql = mysqli_query($conn,"SELECT * FROM users WHERE U_id = $id AND User_type = 0");
    $result = mysqli_fetch_array($sql);
    if(mysqli_num_rows($result)>0){
        return true;
    }else{
        return false;
    }
}


?>