<?php
include __DIR__ . '/../includes/db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $id = isset($_POST['id']) ? intval($_POST['id']) : 0;

  if ($id > 0) {
    $sql = "DELETE FROM prompts WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);

    header('Location: ../prompt/liste_prompts.php');
    exit;
  }
}

echo "Suppression invalide.";