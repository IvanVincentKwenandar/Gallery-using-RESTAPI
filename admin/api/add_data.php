<?php

// session_start();
// include "connect.php";

// // Set headers to allow access from any domain
// header("Access-Control-Allow-Origin: *");
// header("Access-Control-Allow-Methods: POST");
// header("Access-Control-Allow-Headers: Content-Type");

//     $target_dir = "picts/";
//     $target_file = $target_dir . basename($_FILES["image"]["name"]);
//     $uploadOk = 1;
//     $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    

// if($_SERVER['REQUEST_METHOD']=="POST"){
//     $newfilename= time().str_replace(" ", "", basename($_FILES["image"]["name"]));
//     $name = $_POST['name'];
//     $imgname = "admin/api/" . $target_dir . $newfilename;
//     $image = $_FILES['image']['name'];
//     $username = $_SESSION["admins"];
//     $temp;
    
//     if($username != ""){
//         $sql = "SELECT `UserId` FROM `useracc` WHERE `Username` = ?";
//         $stmt = $pdo->prepare($sql);
//         $stmt->execute([$username]);
        
//         while($row = $stmt->fetch()){
//             $temp = $row["UserId"];
//         }

//     }

    
//     //echo $nama . " ". $nrp;

//     if($username != "" && $image != "" && $name != ""){
//         $sql = "INSERT INTO `images`(`idGambar`, `namaGambar`, `pathImage`, `idUser`) VALUES (default,?,?,?)";
//         $stmt = $pdo->prepare($sql);
//         $stmt->execute([$name, $imgname, $temp]);

        
//         //check image 1
//         $check = getimagesize($_FILES["image"]["tmp_name"]);
//         if($check != false) {
//             $uploadOk = 1;
//         } else {
//             $uploadOk = 0;
//         }

//         //check image 2
//         if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
//             echo "Sorry, only JPG, JPEG & PNG files are allowed.";
//         $uploadOk = 0;
//         }

//         if ($uploadOk == 0) {
//             echo "Sorry, your file was not uploaded.";
//         } else {
//             if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_dir . $newfilename)) {
//                 echo "<script> alert('Upload Success'); </script>";
//                 header("location: ../index.php");
                
//             } else {
//                 echo "<script> alert('Failed to Upload Data'); </script>";
//             }
//         }
//     }
// }


session_start();
include "connect.php";

// Set headers to allow access from any domain
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type");

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $target_dir = "picts/";
    $target_file = $target_dir . basename($_FILES["image"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    
    $newfilename = time().str_replace(" ", "", basename($_FILES["image"]["name"]));
    $name = $_POST['name'];
    $imgname = "admin/api/" . $target_dir . $newfilename;
    $image = $_FILES['image']['name'];
    $username = $_SESSION["admins"];
    $temp;
    
    if($username != ""){
        $sql = "SELECT `UserId` FROM `useracc` WHERE `Username` = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$username]);
        
        while($row = $stmt->fetch()){
            $temp = $row["UserId"];
        }
    }

    if ($username != "" && $image != "" && $name != ""){
        $sql = "INSERT INTO `images`(`idGambar`, `namaGambar`, `pathImage`, `idUser`) VALUES (default,?,?,?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$name, $imgname, $temp]);
        
        //check image 1
        $check = getimagesize($_FILES["image"]["tmp_name"]);
        if ($check != false) {
            $uploadOk = 1;
        } else {
            $uploadOk = 0;
        }
        
        //check image 2
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
            http_response_code(400);
            echo json_encode(array("message" => "Sorry, only JPG, JPEG & PNG files are allowed."));
           
        }
        
        $newPathfor = "../Tekweb/admin/api";

        if ($uploadOk == 0) {
            http_response_code(400);
            echo json_encode(array("message" => "Sorry, your file was not uploaded."));
            exit();
        } else {
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $newPathfor . $target_dir . $newfilename)) {
                http_response_code(201);
                echo json_encode(array("message" => "Upload Success"));
                exit();
            } else {
                http_response_code(500);
                echo json_encode(array("message" => "Failed to Upload Data"));
                exit();
            }
        }
    } else {
        http_response_code(400);
        echo json_encode(array("message" => "Please provide valid inputs."));
        exit();
    }
} else {
    http_response_code(405);
    echo json_encode(array("message" => "Invalid request method."));
    exit();
}



?>