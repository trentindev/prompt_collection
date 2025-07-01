<?php
// Détection de l’environnement
require_once __DIR__ . '/../includes/db_connect.php';

// Récupération des types
$types = mysqli_query($conn, "SELECT id, nom FROM types");

// Récupération des outils
$outils = mysqli_query($conn, "SELECT id, nom FROM outils");
?>

<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <title>Ajouter un prompt</title>
  <link rel="stylesheet" href="../asset/style.css">
</head>

<body>
  <?php include __DIR__ . '/../includes/header.php'; ?>
  <h1>Ajouter un nouveau prompt</h1>

  <form action="../helper/traitement_prompt.php" method="POST">
    <label for="titre">Titre :</label><br>
    <input type="text" name="titre" required><br><br>

    <label for="contenu">Contenu :</label><br>
    <textarea name="contenu" rows="6" required></textarea><br><br>

    <label for="type">Type :</label><br>
    <select name="id_type" required>
      <?php while ($type = mysqli_fetch_assoc($types)): ?>
        <option value="<?= $type['id'] ?>"><?= htmlspecialchars($type['nom']) ?></option>
      <?php endwhile; ?>
    </select><br><br>

    <label for="outil">Outil (facultatif) :</label><br>
    <select name="id_outil">
      <option value="">-- Aucun --</option>
      <?php while ($outil = mysqli_fetch_assoc($outils)): ?>
        <option value="<?= $outil['id'] ?>"><?= htmlspecialchars($outil['nom']) ?></option>
      <?php endwhile; ?>
    </select><br><br>

    <label for="observation">Observation (facultatif) :</label><br>
    <textarea name="observation" rows="3"></textarea><br><br>

    <label>
      <input type="checkbox" name="favori" value="1"> Marquer comme favori
    </label><br><br>

    <button type="submit">Enregistrer le prompt</button>
  </form>
</body>

</html>