<?php

// include "api/connect.php";

// $sql = "SELECT `idGambar`, `namaGambar`, `pathImage`, `idUser` FROM `images`";
// $stmt = $pdo->prepare($sql);
// $stmt->execute();

// $response = array();

// if ($stmt ){
//     while($row = $stmt->fetch()){ 
//         $nama = $row["namaGambar"];
//         $foto = $row["pathImage"];
//         $user = $row["idUser"];
//         $idfoto = $row["idGambar"];

//         $user_sql = "SELECT `Username` FROM `useracc` WHERE `UserId` = $user";
//         $user_stmt = $pdo->prepare($user_sql);
//         $user_stmt->execute();

//         $namauser2 = "";

//         if($user_stmt ){
//             while($user_row = $user_stmt->fetch()){
//                 $namauser2 = $user_row["Username"];
//             }
//         }

//         $image_data = array(
//             "id" => $idfoto,
//             "name" => $nama,
//             "path" => $foto,
//             "user" => $namauser2
//         );

//         array_push($response, $image_data);
//     }
// }

// header('Content-Type: application/json');
// echo json_encode($response);



include "connect.php";

$sql = "SELECT `idGambar`, `namaGambar`, `pathImage`, `idUser` FROM `images`";
$stmt = $pdo->prepare($sql);
$stmt->execute();

if ($stmt ){
    $images = array();
    while($row = $stmt->fetch()){ 
        $image = array(
            "id" => $row["idGambar"],
            "name" => $row["namaGambar"],
            "url" => "http://localhost/Tekweb/" . $row["pathImage"],
            "uploaded_by" => ""
        );

        $user_id = $row["idUser"];
        $sql3 = "SELECT `Username` FROM `useracc` WHERE `UserId` = $user_id";
        $stmt3 = $pdo->prepare($sql3);
        $stmt3->execute();

        if($stmt3 ){
            while($row3 = $stmt3->fetch()){
                $image["uploaded_by"] = $row3["Username"];
            }
        }

        array_push($images, $image);
    }

    echo json_encode($images);
}


?>
