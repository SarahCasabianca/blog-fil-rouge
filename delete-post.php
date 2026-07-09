<?php

require_once(__DIR__ . '/head.php');

if (
    !isset($_SESSION['LOGGED_USER'])
    || $_SESSION['LOGGED_USER']['role'] !== 'admin'
) {
    redirectToUrl('read.php');
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

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Article supprimé</title>
</head>
<body>
    <p>Suppression validée.</p>

    <a class="btn btn-primary" role="button" href="read.php">RETOUR</a>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>
</html>