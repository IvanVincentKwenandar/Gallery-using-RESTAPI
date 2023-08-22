<?php

session_start();

include "connect.php";

if($_SERVER['REQUEST_METHOD']=="POST"){
    $username = $_POST['username'];
    $pass =$_POST['pass'];
    $admin = $_POST['username'];
    //echo $nama . " ". $nrp;

    if($username != "" && $pass != ""){
        $sql = "SELECT * FROM `useracc` WHERE `Username` = ? AND `Password` = password(?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$username, $pass]);
        $row = $stmt -> fetch();
        
        if($stmt-> rowCount()!= 0){
            echo "<script> alert('Login Success'); </script>";
            // header("location: ../Mainmenu.php");
            header("location: ../Mainmenu.php");

            $_SESSION["check"] = true;
            $_SESSION["admins"] = $_POST['username'];
            
        }else{
            echo "<script> alert('Wrong Username or Password'); </script>";
            header("location: ../login.php?stat=1");
        }
    }

}else{
    exit();
}


?>
