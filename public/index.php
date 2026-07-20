<?php

session_start(); // Démarrage de la session

// Inclusion des fichiers communs
require_once('../common/connect.php');         // Connexion BDD
require_once('../common/config.php');     // Configuration
require_once('../common/functions.php');  // Fonctions utilitaires
require_once('../common/variables.php');  // Whitelist des pages

// 1. Gestion des articles (avec ID)
if (isset($_GET['page']) && $_GET['page'] === 'articles' && isset($_GET['id'])) {
    include('../common/dbArticle.php');   // Récupère l'article
    include('../common/header.php');
    include("../pages/article.php");      // Affiche l'article
}
// 2. Pages whitelistées
elseif (isset($_GET['page']) && array_key_exists($_GET['page'], $whitelist)) {
    include('../common/header.php');
    include("../pages/" . $_GET['page'] . '.php');
}
// 3. Page d'accueil par défaut
elseif (!isset($_GET['page'])) {
    include('../common/header.php');
    include('../pages/read.php');
}
// 4. Erreur 404
else {
    include('../common/header.php');
    echo "<div class='alert alert-danger'>Vous êtes perdu ?</div>";
}

include('../common/footer.php'); // Footer commun à toutes les pages

?>