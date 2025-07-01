<?php
// On inclut le fichier config.php qui contient la connexion à la base

//include 'config_local.php';
include 'config_infinity.php';

// Si l'inclusion s'est bien passée, la variable $conn est déjà disponible
if ($conn) {
  echo "Connexion réussie à la base de données locale !";
} else {
  echo "Erreur de connexion : " . mysqli_connect_error();
}