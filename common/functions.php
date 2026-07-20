<?php

function truncateString($string, $length = 20)
{
    if (strlen($string) > $length) {
        return substr($string, 0, $length) . ' (...)';
    }
    return $string;
}

function redirectToUrl(string $url): never
{
    // Envoi d'un header HTTP pour rediriger le navigateur
    header("Location: {$url}");
    // Arrêt du script pour éviter d'exécuter du code après la redirection
    exit();
}

if (isset($_GET['action']) && $_GET['action'] === 'logout') {

    // Suppression de toutes les variables de session (LOGGED_USER, etc.)
    session_unset();

    // Destruction complète de la session
    session_destroy();

    // Redirection vers la page d'accueil
    header("Location:read.php");
    exit();
}

$sqlQueryAbo = 'SELECT * FROM `abonnes`';
$abobdd = $mysqlClient->prepare($sqlQueryAbo);
$abobdd->execute();
$abonnes = $abobdd->fetchAll();

function slugify($text)
{
    $text = iconv('UTF-8', 'ASCII//TRANSLIT', $text);
    $text = strtolower($text);
    $text = preg_replace('/[^a-z0-9]+/', '-', $text);
    $text = trim($text, '-');

    return $text;
}

function logAction(string $action, array $donnees = [])
{
    $logFile = __DIR__ . '/articles_logs.json';   // ← le nom de fichier du prof

    $logs = [];
    if (file_exists($logFile)) {
        $logs = json_decode(file_get_contents($logFile), true) ?? [];
    }

    $logs[] = [
        'timestamp'  => date('Y-m-d H:i:s'),      // ← "timestamp", comme chez lui
        'action'     => $action,
        'ip'         => $_SERVER['REMOTE_ADDR'] ?? 'inconnue',
        'user_agent' => $_SERVER['HTTP_USER_AGENT'] ?? 'inconnu',
        'data'       => $donnees,                 // ← "data", comme chez lui
    ];

    file_put_contents($logFile, json_encode($logs, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
}

?>