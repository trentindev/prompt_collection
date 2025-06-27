<?php
$page = basename($_SERVER['PHP_SELF']);
echo '
<nav>
    <ul>
        <li><a href="index.php" ' . ($page === 'index.php' ? 'class="active"' : '') . '>Accueil</a></li>
        <li><a href="ajout_prompt.php" ' . ($page === 'ajout_prompt.php' ? 'class="active"' : '') . '>Ajouter un prompt</a></li>
        <li><a href="liste_prompts.php" ' . ($page === 'liste_prompts.php' ? 'class="active"' : '') . '>Liste des prompts</a></li>
    </ul>
</nav>';