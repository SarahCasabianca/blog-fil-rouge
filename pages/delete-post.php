<?php

if (
    !isset($_SESSION['LOGGED_USER'])
    || $_SESSION['LOGGED_USER']['role'] !== 'admin'
) {
    redirectToUrl('read.html');
}

$postData = $_POST;

if(!isset($postData['id']) || !is_numeric($postData['id'])) {
    echo 'Il faut un identifiant valide pour supprimer un article';
    return;
}

$deleteArticleStatement = $mysqlClient->prepare('DELETE FROM articles_presse WHERE id = :id');

$deleteArticleStatement->execute([
    'id' => (int)$postData['id']
]);

logAction('suppression', ['id' => (int)$postData['id']]);

// Stocker le message de succès en session
$_SESSION['SUCCESS_MESSAGE'] = "L'article a été définitivement supprimé !";

// Rediriger vers edit.php avec l'ID
header('Location: read.html');
?>