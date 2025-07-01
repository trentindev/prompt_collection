<?php
require_once __DIR__ . '/../includes/constants.php';

$script_name = basename($_SERVER['SCRIPT_NAME']);

echo '
<nav>
    <ul>
        <li><a href="' . BASE_URL . '/index.php" ' . ($script_name === 'index.php' ? 'class="active"' : '') . '>Accueil</a></li>
        <li><a href="' . BASE_URL . '/prompt/ajout_prompt.php" ' . ($script_name === 'ajout_prompt.php' ? 'class="active"' : '') . '>Ajouter un prompt</a></li>
        <li><a href="' . BASE_URL . '/prompt/liste_prompts.php" ' . ($script_name === 'liste_prompts.php' ? 'class="active"' : '') . '>Liste des prompts</a></li>
    </ul>
</nav>';