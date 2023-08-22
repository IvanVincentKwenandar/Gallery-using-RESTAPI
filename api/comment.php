<?php

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

if ($_SERVER['REQUEST_METHOD'] != "POST") {
  http_response_code(405);
  echo json_encode(array("message" => "Invalid request method"));
  exit;
}

// Extract photo ID from request body
$idPhoto = $input["idfoto"];
$komentar = $input["komentar"];
$username = $_SESSION["admins"];

if($username != ""){
  $sql = "SELECT `UserId` FROM `useracc` WHERE `Username` = ?";
  $stmt = $pdo->prepare($sql);
  $stmt->execute([$username]);
  
  while($row = $stmt->fetch()){
      $temp = $row["UserId"];
  }
}

// Get path to image file from database
$sql2 = "SELECT `pathImage` FROM `images` WHERE `idGambar` = ?";
$stmt2 = $pdo->prepare($sql2);
$stmt2->execute([$idPhoto]);

$row = $stmt2->fetch();
$file_path = "../" . $row['pathImage'];

if (!file_exists($file_path)) {
  exit;
}

// Insert comment to photo record from database
$sql = "INSERT INTO `comment`(`id_kom`, `komm`, `id_gambar`, `id_user`) VALUES (default,?,?,?)";
$stmt = $pdo->prepare($sql);
$stmt->execute([$komentar, $idPhoto, $temp]);

http_response_code(200);
echo json_encode(array("message" => "Comment Success"));

?>