<?php

include('connect.php');

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

$insertcontenu = $mysqlClient->prepare('INSERT INTO articles_presse(titre, contenu, auteur, date_publication, match_id) VALUES (:titre, :contenu, :auteur, ;date_publication, :match_id)');

$insertcontenu->execute([
    'titre' => $titre,
    'contenu' => $contenu,
    'auteur' => $auteur,
    'date_publication' => date('Y-m-d'),
    'match_id' => 0,
])

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajout dans la BDD</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>
<body class="container flex-column min-vh-100">
    <div class="container">
        <h1>Article ajouté avec succès !</h1>

        <div class="card">
            <div class="card-body">
                <h5 class="card-tittle"><?= $titre; ?></h5>
                <p class="card-text"><b>Par <?= $auteur; ?></b></p>
                <p class="card-text"><?= $contenu; ?></p>
            </div>
        </div>

        <a class="btn btn-primary" role="button" href="read.php">RETOUR</a>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>
</html>