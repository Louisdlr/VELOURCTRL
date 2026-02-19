<?php
// Affiche les erreurs (dev only)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Session
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// --- CONFIG BDD (à adapter si besoin) ---
define('DB_HOST', 'localhost');
define('DB_NAME', 'velour_ctrl_db');  
define('DB_USER', 'root');
define('DB_PASS', ''); 
define('BASE_URL', '/VELOUR_CTRL/public');

/**
 * Retourne une connexion PDO unique (singleton)
 */
function db(): PDO
{
    static $pdo = null;

    if ($pdo === null) {
        $dsn = 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8mb4';
        $options = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ];

        $pdo = new PDO($dsn, DB_USER, DB_PASS, $options);
    }

    return $pdo;
}
