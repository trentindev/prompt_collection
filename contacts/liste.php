<?php
// Détection de l’environnement
if (strpos($_SERVER['HTTP_HOST'], 'localhost') !== false) {
  include 'config_local.php';
} else {
  include 'config_infinity.php';
}

// Requête pour récupérer les contacts
$sql = "SELECT * FROM contacts ORDER BY date_creation DESC";
$result = mysqli_query($conn, $sql);

// Début de la page HTML
echo '<!DOCTYPE html><html lang="fr"><head><meta charset="UTF-8">';
echo '<title>Liste des contacts</title>';
echo '<link rel="stylesheet" href="style.css">';
echo '</head><body>';
echo '<h1>Liste des contacts enregistrés</h1>';

// Affichage du tableau si des résultats existent
if (mysqli_num_rows($result) > 0) {
  echo '<table>';
  echo '<tr><th>Prénom</th><th>Nom</th><th>Email</th><th>Message</th><th>Date</th></tr>';

  while ($row = mysqli_fetch_assoc($result)) {
    echo "<tr>
                <td>{$row['prenom']}</td>
                <td>{$row['nom']}</td>
                <td>{$row['email']}</td>
                <td>{$row['message']}</td>
                <td>{$row['date_creation']}</td>
              </tr>";
  }

  echo '</table>';
} else {
  echo "<p>Aucun contact enregistré pour l’instant.</p>";
}

// Fin de la page HTML
echo '</body></html>';

// Fermeture de la connexion
mysqli_close($conn);
?>