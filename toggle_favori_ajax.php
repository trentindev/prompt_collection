<?php
header('Content-Type: application/json');

if (strpos($_SERVER['HTTP_HOST'], 'localhost') !== false) {
  include 'config_local.php';
} else {
  include 'config_infinity.php';
}

$id = isset($_POST['id']) ? intval($_POST['id']) : 0;

if ($id <= 0) {
  echo json_encode(['success' => false, 'error' => 'ID invalide.']);
  exit;
}

// Vérifier le favori actuel
$sql = "SELECT favori FROM prompts WHERE id = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$row = mysqli_fetch_assoc($result);

if (!$row) {
  echo json_encode(['success' => false, 'error' => 'Prompt introuvable.']);
  exit;
}

$new_favori = $row['favori'] ? 0 : 1;

$update = "UPDATE prompts SET favori = ? WHERE id = ?";
$stmt2 = mysqli_prepare($conn, $update);
mysqli_stmt_bind_param($stmt2, "ii", $new_favori, $id);
mysqli_stmt_execute($stmt2);

echo json_encode(['success' => true, 'favori' => $new_favori]);