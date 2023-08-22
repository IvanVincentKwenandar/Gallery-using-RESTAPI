<?php
// session_start();
// include "connect.php";

// if($_SERVER['REQUEST_METHOD']=="POST"){

//     $idPhoto = $_POST["idfoo"];
//     $editname = $_POST["edit"];
//     $sql = "UPDATE `images` SET `namaGambar` = ? WHERE `idGambar` = ?";
//     $stmt = $pdo->prepare($sql);
//     $stmt->execute([$editname, $idPhoto]);
//     echo "<script> alert('Edit Success'); </script>";
//     header("location: ../Mainmenu.php");

// }
//Include the database connection and headers for CORS
include "connect.php";
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// Parse incoming request data
$inputJSON = file_get_contents('php://input');
$input = json_decode($inputJSON, true);

if (json_last_error() !== JSON_ERROR_NONE) {
  http_response_code(400);
  echo json_encode(array("message" => "Invalid JSON data: " . json_last_error_msg()));
  exit;
}

if ($_SERVER['REQUEST_METHOD'] != "POST") {
  http_response_code(405);
  echo json_encode(array("message" => "Invalid request method"));
  exit;
}

if (!isset($input["idfoto"]) || !isset($input["edit"])) {
  http_response_code(400);
  echo json_encode(array("message" => "Missing parameters"));
  exit;
}

// Extract photo ID from request body
$idPhoto = $input["idfoto"];
$editname = $input["edit"];

// Get path to image file from database
$sql2 = "SELECT `pathImage` FROM `images` WHERE `idGambar` = ?";
$stmt2 = $pdo->prepare($sql2);
$stmt2->execute([$idPhoto]);

$row = $stmt2->fetch();
$file_path = "../" . $row['pathImage'];

if (!file_exists($file_path)) {
  http_response_code(404);
  echo json_encode(array("message" => "Image not found"));
  exit;
}

//Update the database
$sql = "UPDATE `images` SET `namaGambar` = ? WHERE `idGambar` = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$editname, $idPhoto]);

http_response_code(200);
echo json_encode(array("message" => "Edit Success"));

?>