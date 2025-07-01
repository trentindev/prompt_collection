<?php
// Détection de l’environnement
if (strpos($_SERVER['HTTP_HOST'], 'localhost') !== false) {
  include __DIR__ . '/../config/config_local.php';
} else {
  include __DIR__ . '/../config/config_infinity.php';
}