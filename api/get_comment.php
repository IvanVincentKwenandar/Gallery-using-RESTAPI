<?php
include "connect.php";

$idfoto = $_GET['id_foto'];

$sql = "SELECT c.komm, u.Username FROM `comment` c JOIN `useracc` u ON c.id_user = u.UserId WHERE c.id_gambar = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$idfoto]);

$comments = [];
if ($stmt) {
  while ($row = $stmt->fetch()) {
    $comments[] = $row;
  }
}

echo json_encode($comments);

?>