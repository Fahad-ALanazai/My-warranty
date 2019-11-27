<?php
$conn = mysqli_connect("localhost","root","","My_Warranty");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

