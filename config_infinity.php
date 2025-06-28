<?php
// Paramètres de connexion à la base de données
$host = 'sql303.infinityfree.com';           // Exemple : sql303.infinityfree.com Adaptez avec vos identifiants
$user = 'if0_39309459';              // Votre Identifiant InfinityFree 
$password = 'wVSO6QASHK5enIE';     // Mot de passe MySQL
$dbname = 'if0_39309459_intro_web';   // Nom exact de la base 

// Connexion
$conn = mysqli_connect($host, $user, $password, $dbname);

// Vérification de la connexion
if (!$conn) {
  die("Connexion échouée : " . mysqli_connect_error());
}

// Important : forcer l'encodage en UTF-8 pour éviter les problèmes d'affichage
mysqli_set_charset($conn, "utf8mb4");