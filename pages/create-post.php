<?php

if ( !hasRole('admin') && !hasRole('owner') ) {

// Stocker le message de succès en session
$_SESSION['FAIL_MESSAGE'] = "Vous n'avez pas les droits pour ajouter un article! Retour vers la page d'accueil;";

// Rediriger vers edit.php avec l'ID
header('Location: read.html');
exit;
}

$postData = $_POST;

if (
    empty($postData['titre'])
    || empty($postData['contenu'])
    || empty($postData['auteur'])
    || trim(strip_tags($postData['titre'])) === ''
    || trim(strip_tags($postData['contenu'])) === ''
    || trim(strip_tags($postData['auteur'])) === ''
) {
    echo 'Il faut un titre + un contenu + un auteur pour soumettre le formulaire.';
    return;
}

$titre = trim(strip_tags($postData['titre']));
$contenu = trim(strip_tags($postData['contenu']));
$auteur = trim(strip_tags($postData['auteur']));

$insertcontenu = $mysqlClient->prepare('INSERT INTO articles_presse(titre, contenu, auteur, date_publication, match_id) VALUES (:titre, :contenu, :auteur, :date_publication, :match_id)');

$insertcontenu->execute([
    'titre' => $titre,
    'contenu' => $contenu,
    'auteur' => $auteur,
    'date_publication' => date('Y-m-d'),
    'match_id' => NULL,
]);

logAction('creation', ['titre' => $titre, 'auteur' => $auteur]);

// Récupérer l'ID du dernier article supprimé
$lastId = $postData['id'];

// Stocker le message de succès en session
$_SESSION['SUCCESS_MESSAGE'] = "L'article a été ajouté avec succès ! Vous pouvez le corriger si nécessaire :";

// Rediriger vers edit.php avec l'ID
header('Location: update.html?id=' . $lastId);
exit;
?>