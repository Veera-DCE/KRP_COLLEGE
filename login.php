<?php
session_start();
require "config.php";

$Username = $_POST['username'];
$Password = $_POST['password'];
$_SESSION['uname'] = $Username;

$find_query = "SELECT * FROM `users` WHERE `username` ='$Username' AND `password`='$Password'";
$result = mysqli_query($con, $find_query);
if(mysqli_num_rows($result) > 0 ) {
    while($row = mysqli_fetch_array($result)) {
        $_SESSION['uname'] = $row['username'];
        echo "<script> window.location.href='dashboard.php' </script>";
    }
}
else {
    echo "<script>alert('Incorrect Username or Password')</script>";
    echo "<script> window.location.href='index.php' </script>";
}
?>