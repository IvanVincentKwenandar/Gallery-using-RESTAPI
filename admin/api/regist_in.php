<?php
session_start();
$host        ="localhost";
$user        ="root";
$pass        ="";
$database    ="teknologiwebsitedb";
$db = mysqli_connect($host, $user, $pass, $database) or die("gagal koneksi ke database");
$init = 0;
$username = $_POST['username'];
$password = $_POST['pass'];
$sql="INSERT INTO `useracc` (`Username`, `Password`)
VALUES ('$username', password('$password'))";

if ($db->query($sql) === TRUE) {
    echo "<script> alert('Registration Successfull'); </script>";
    header("location:../login.php");
} else {
    echo "Error: " . $sql . "<br>" . $db->error;
}