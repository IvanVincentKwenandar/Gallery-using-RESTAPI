<?php 

session_start();
include "connect.php";

if($_SERVER['REQUEST_METHOD']=="POST"){
    $target_dir = "localhost/Tekweb/";

    $idPhoto = $_POST["idfoo"];

    $sql = "SELECT `pathImage` FROM `images` WHERE `idGambar` = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$idPhoto]);

    $path;

    while($row = $stmt->fetch()){
        $path = $row["pathImage"];
    }

    $target_path = $target_dir . $path;

    

    echo "<script> alert('$target_path'); </script>";

    // header("location:../Mainmenu.php");

}


?>