<?php 

// session_start();
// include "connect.php";

// if($_SERVER['REQUEST_METHOD']=="POST"){

//     $idPhoto = $_POST["idfoo"];
    
//     $sql2 = "SELECT `pathImage` FROM `images` WHERE `idGambar` = ?";
//     $stmt2 = $pdo->prepare($sql2);
//     $stmt2->execute([$idPhoto]);
//     $file_path;

//     while($row = $stmt2->fetch()){
//         $file_path = $row["pathImage"];
//         if(array_key_exists($file_path, $_POST)){
//             if(file_exists($file_path)){
//                 unlink($file_path);
//                 echo "<script> alert('Delete from directory success'); </script>";
//             }else{
//                 echo "<script> alert('Error, file not found'); </script>";
//             }
//         }else{
//             echo "<script> alert('Error'); </script>";
//         }
        
//     }

    


//     $sql = "DELETE FROM `images` WHERE `idGambar` = ?";
//     $stmt = $pdo->prepare($sql);
//     $stmt->execute([$idPhoto]);

//     echo "<script> alert('Delete Success'); </script>";
//     header("location: ../Mainmenu.php");

// }

// include "connect.php";

// // Set headers to allow access from any domain
// header("Access-Control-Allow-Origin: *");
// header("Access-Control-Allow-Methods: POST");
// header("Access-Control-Allow-Headers: Content-Type");

// // Parse incoming request data
// $inputJSON = file_get_contents('php://input');
// $input = json_decode($inputJSON, true);

// if ($_SERVER['REQUEST_METHOD'] == "POST") {

//   // Extract photo ID from request body
//   $idPhoto = $input["idfoo"];

//   // Get path to image file from database
//   $sql2 = "SELECT `pathImage` FROM `images` WHERE `idGambar` = ?";
//   $stmt2 = $pdo->prepare($sql2);
//   $stmt2->execute([$idPhoto]);

//   $file_path;

//   while ($row = $stmt2->fetch()) {
//     $file_path = $row["pathImage"];
//     if (array_key_exists($file_path, $input)) {
//       if (file_exists($file_path)) {
//         unlink($file_path);
//         echo json_encode(array("message" => "Delete from directory success"));
//       } else {
//         echo json_encode(array("message" => "Error, file not found"));
//       }
//     } else {
//       echo json_encode(array("message" => "Error"));
//     }
//   }

//   // Delete photo record from database
//   $sql = "DELETE FROM `images` WHERE `idGambar` = ?";
//   $stmt = $pdo->prepare($sql);
//   $stmt->execute([$idPhoto]);

//   echo json_encode(array("message" => "Delete Success"));

// } else {
//   echo json_encode(array("message" => "Invalid request method"));
// }

// include "connect.php";

// // Set headers to allow access from any domain
// header("Access-Control-Allow-Origin: *");
// header("Access-Control-Allow-Methods: POST");
// header("Access-Control-Allow-Headers: Content-Type");

// // Parse incoming request data
// $inputJSON = file_get_contents('php://input');
// $input = json_decode($inputJSON, true);

// if ($_SERVER['REQUEST_METHOD'] == "POST") {

//   // Extract photo ID from request body
//   $idPhoto = $input["idfoo"];

//   // Get path to image file from database
//   $sql2 = "SELECT `pathImage` FROM `images` WHERE `idGambar` = ?";
//   $stmt2 = $pdo->prepare($sql2);
//   $stmt2->execute([$idPhoto]);

//   $file_path = ''; // Initialize to an empty string

//   while ($row = $stmt2->fetch()) {
//     $file_path = $row["pathImage"];
//     if (array_key_exists($file_path, $input)) {
//       if (file_exists($file_path)) {
//         unlink($file_path);
//         echo json_encode(array("message" => "Delete from directory success"));
//       } else {
//         echo json_encode(array("message" => "Error, file not found"));
//       }
//     } else {
//       echo json_encode(array("message" => "Error"));
//     }
//   }

//   // Delete photo record from database
//   $sql = "DELETE FROM `images` WHERE `idGambar` = ?";
//   $stmt = $pdo->prepare($sql);
//   $stmt->execute([$idPhoto]);

//   echo json_encode(array("message" => "Delete Success"));

// } else {
//   echo json_encode(array("message" => "Invalid request method"));
// }
 

include "connect.php";

// Set headers to allow access from any domain
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type");

// Parse incoming request data
$inputJSON = file_get_contents('php://input');
$input = json_decode($inputJSON, true);

if (json_last_error() !== JSON_ERROR_NONE) {
  http_response_code(400);
  echo json_encode(array("message" => "Invalid JSON data"));
  exit;
}

if ($_SERVER['REQUEST_METHOD'] != "DELETE") {
  http_response_code(405);
  echo json_encode(array("message" => "Invalid request method"));
  exit;
}

// Extract photo ID from request body
$idPhoto = $input["idfoto"];

// Get path to image file from database
$sql2 = "SELECT `pathImage` FROM `images` WHERE `idGambar` = ?";
$stmt2 = $pdo->prepare($sql2);
$stmt2->execute([$idPhoto]);

$row = $stmt2->fetch();
$file_path = "../" . $row['pathImage'];

if (file_exists($file_path)) {
  unlink($file_path);
}

// Delete photo record from database
$sql = "DELETE FROM `images` WHERE `idGambar` = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$idPhoto]);

http_response_code(200);
echo json_encode(array("message" => "Delete Success"));

?>