<?php

// Détection de l’environnement
include __DIR__ . '/../includes/db_connect.php';

// Requête SQL avec jointures pour récupérer type et outil (si présent)
$sql = "
  SELECT p.*, t.nom AS type_nom, o.nom AS outil_nom
  FROM prompts p
  JOIN types t ON p.id_type = t.id
  LEFT JOIN outils o ON p.id_outil = o.id
  ORDER BY p.date_creation DESC
";

$result = mysqli_query($conn, $sql);

// Début HTML
?>
<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <title>Liste des Prompts</title>
  <link rel="stylesheet" href="../asset/style.css">
</head>

<body>
  <?php include __DIR__ . '/../includes/header.php'; ?>
  <h1>Liste des Prompts enregistrés</h1>

  <table>
    <thead>
      <tr>
        <th>Titre</th>
        <th>Contenu</th>
        <th>Type</th>
        <th>Outil</th>
        <th>Observation</th>
        <th>Favori</th>
        <th>Supprimer</th>
      </tr>
    </thead>
    <tbody>
      <?php if (mysqli_num_rows($result) > 0): ?>
        <?php while ($row = mysqli_fetch_assoc($result)): ?>
          <tr>
            <td><?= htmlspecialchars($row['titre']) ?></td>
            <td>
              <div class="contenu-prompt"><?= nl2br($row['contenu']) ?></div>
              <div class="prompt-actions">
                <button class="toggle-btn">Voir plus</button>
                <button class="copy-btn" data-content="<?= htmlspecialchars($row['contenu']) ?>">Copier</button>
              </div>
            </td>

            <td><?= htmlspecialchars($row['type_nom']) ?></td>
            <td><?= $row['outil_nom'] ?? '—' ?></td>
            <td><?= $row['observation'] ?? '' ?></td>
            <td>
              <span class="toggle-favori" data-id="<?= $row['id'] ?>" style="cursor:pointer">
                <?= $row['favori'] ? '⭐' : '☆' ?>
              </span>
            </td>
            <td>
              <form class="delete-form" action="../helper/delete_prompt.php" method="POST"
                onsubmit="return confirm('Confirmer la suppression ?');">
                <input type="hidden" name="id" value="<?= $row['id'] ?>">

                <button type="submit" class="delete-btn" title="Supprimer">
                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="trash-icon">
                    <path fill="currentColor"
                      d="M268 416h24a12 12 0 0012-12V204a12 12 0 00-12-12h-24a12 12 0 00-12 12v200a12 12 0 0012 12zm-88 0h24a12 12 0 0012-12V204a12 12 0 00-12-12h-24a12 12 0 00-12 12v200a12 12 0 0012 12zm184-336h-72l-9.4-18.7A24 24 0 00360 48H88a24 24 0 00-21.6 13.3L57 80H8A8 8 0 000 88v16a8 8 0 008 8h16l21.2 339a48 48 0 0047.9 45h261.9a48 48 0 0047.9-45L424 112h16a8 8 0 008-8V88a8 8 0 00-8-8zM128 432a16 16 0 01-16-15.1L90.8 128h266.4L336 416a16 16 0 01-16 16H128z" />
                  </svg>
                </button>
              </form>
            </td>
          </tr>
        <?php endwhile; ?>
      <?php else: ?>
        <tr>
          <td colspan="7">Aucun prompt enregistré.</td>
        </tr>
      <?php endif; ?>
    </tbody>
  </table>

  <p><a href="ajout_prompt.php">Ajouter un nouveau prompt</a></p>
  <?php include __DIR__ . '/../includes/footer.php'; ?>

  <script>
    // Copie
    document.querySelectorAll('.copy-btn').forEach(btn => {
      btn.addEventListener('click', () => {
        const contenu = btn.getAttribute('data-content');
        navigator.clipboard.writeText(contenu).then(() => {
          btn.textContent = 'Copié !';
          setTimeout(() => btn.textContent = 'Copier', 1500);
        }).catch(err => {
          console.error('Erreur lors de la copie :', err);
        });
      });
    });
  </script>
  <script>
    // Bouton Voir plus / Réduire
    document.querySelectorAll('.toggle-btn').forEach(btn => {
      btn.addEventListener('click', () => {
        const promptDiv = btn.closest('td').querySelector('.contenu-prompt');
        promptDiv.classList.toggle('expanded');
        btn.textContent = promptDiv.classList.contains('expanded') ? 'Réduire' : 'Voir plus';
      });
    });

    // Bouton Copier
    document.querySelectorAll('.copy-btn').forEach(btn => {
      btn.addEventListener('click', () => {
        const content = btn.getAttribute('data-content');
        navigator.clipboard.writeText(content).then(() => {
          btn.textContent = 'Copié !';
          setTimeout(() => btn.textContent = 'Copier', 1500);
        }).catch(err => {
          console.error('Erreur de copie :', err);
        });
      });
    });
  </script>

  <!-- Script à la fin du fichier, qui :
- écoute les clics sur les étoiles
- envoie une requête AJAX POST vers toggle_favori_ajax.php
- met à jour dynamiquement l’étoile affichée selon la réponse du serveur 
-->
  <script>
    document.querySelectorAll('.toggle-favori').forEach(elem => {
      console.log(elem);
      elem.addEventListener('click', () => {
        const id = elem.dataset.id;
        console.log('id : ', id)

        fetch('../helper/toggle_favori_ajax.php', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
          },
          body: `id=${id}`
        })
          .then(response => response.json())
          .then(data => {
            if (data.success) {
              elem.textContent = data.favori ? '⭐' : '☆';
            } else {
              alert("Erreur : " + data.error);
            }
          })
          .catch(() => alert("Erreur de communication avec le serveur"));
      });
    });
  </script>

</body>

</html>
<?php mysqli_close($conn); ?>