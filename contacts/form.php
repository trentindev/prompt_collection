<?php
// Détection de l’environnement (local ou InfinityFree)
if (strpos($_SERVER['HTTP_HOST'], 'localhost') !== false) {
  include 'config_local.php';
} else {
  include 'config_infinity.php';
}

// Sécurisation des données reçues via POST
$prenom = htmlspecialchars($_POST['prenom'] ?? '');
$nom = htmlspecialchars($_POST['nom'] ?? '');
$email = htmlspecialchars($_POST['email'] ?? '');
$message = htmlspecialchars($_POST['message'] ?? '');

// Vérifie que les champs obligatoires ne sont pas vides
if ($prenom && $nom && $email) {
  // Requête SQL d’insertion
  $sql = "INSERT INTO contacts (prenom, nom, email, message)
            VALUES ('$prenom', '$nom', '$email', '$message')";

  // Exécution de la requête
  if (mysqli_query($conn, $sql)) {
    echo "✅ Données enregistrées avec succès !<br>";
    echo '<a href="liste.php">Voir la liste des contacts</a>';
  } else {
    echo "❌ Erreur SQL : " . mysqli_error($conn);
  }
} else {
  echo "❗ Tous les champs obligatoires doivent être remplis.";
}

// Fermeture de la connexion
mysqli_close($conn);