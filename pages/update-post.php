<?php

if ( !hasRole('admin') && !hasRole('owner') ) {
    // Stocker le message de succès en session
$_SESSION['FAIL_MESSAGE'] = "Vous n'avez pas les droits pour modifier un article! Retour vers la page d'accueil.";

// Rediriger vers edit.php avec l'ID
header('Location: read.html');
exit;
}

$postData = $_POST;

if (
    !isset($postData['id'])                         
    || !is_numeric($postData['id'])
    || empty($postData['titre'])
    || empty($postData['contenu'])
    || trim(strip_tags($postData['titre'])) === ''
    || trim(strip_tags($postData['contenu'])) === ''
) {
    echo 'Il manque des informations pour permettre l\'édition du formulaire.';
    return;
}

$id = (int)$postData['id'];

$titre = trim(strip_tags($postData['titre']));
$contenu = trim(strip_tags($postData['contenu']));

$insertcontenuStatement = $mysqlClient->prepare('UPDATE articles_presse SET titre = :titre, contenu = :contenu WHERE id = :id');

$insertcontenuStatement->execute([
    'titre' => $titre,
    'contenu' => $contenu,
    'id' => $id,
]);

logAction('modification', ['id' => $id, 'titre' => $titre]);

// Récupérer l'ID du dernier article inséré
$lastId = $postData['id'];

// Stocker le message de succès en session
$_SESSION['SUCCESS_MESSAGE'] = "L'article a été modifié avec succès ! Vous pouvez le corriger une nouvelle fois si necessaire :";

// Rediriger vers edit.php avec l'ID
header('Location: update.html?id=' . $lastId);
exit;
?>