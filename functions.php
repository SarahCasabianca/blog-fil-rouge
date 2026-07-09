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

?>