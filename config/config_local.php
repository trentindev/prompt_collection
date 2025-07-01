<?php
$host = 'localhost';
$user = 'root'; // Changez si vous avez un identifiant différent
$password = 'root'; // Changez si vous avez un password différent
$dbname = 'intro_web'; // Changez si vous avez un nom de base différent

$conn = mysqli_connect($host, $user, $password, $dbname);
//echo ($conn ?: "Erreur de connexion : " . mysqli_connect_error());

if (!$conn) {
  // En cas d'erreur, on ne fait pas echo ici pour ne pas polluer les autres scripts
  // On laisse les scripts inclure ce fichier et gérer les erreurs eux-mêmes
}