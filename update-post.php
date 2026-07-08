<?php

require_once(__DIR__ . '/head.php');

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
])

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Article modifié</title>
</head>
<body class="d-flex flex-column min-vh-100">
    <div class="container">
        <h1>Article mofifié avec succès !</h1>

        <div class="card">
            <div class="card-body">
                <h5 class="card-title"><?= ($titre); ?></h5>

                <p class="card-text"><?= ($contenu); ?></p>
            </div>
        </div>
    </div>

    <a class="btn btn-primary" role="button" href="read.php">RETOUR</a>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>
</html>