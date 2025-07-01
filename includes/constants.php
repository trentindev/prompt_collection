<?php
// Détection du serveur
$isLocalhost = strpos($_SERVER['HTTP_HOST'], 'localhost') !== false;

// BASE_URL dépend de l’environnement
define('BASE_URL', $isLocalhost ? '/prompt_collection' : '');