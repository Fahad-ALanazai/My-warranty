<?php
$conn = mysqli_connect("localhost","root","","My-Warranty");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

