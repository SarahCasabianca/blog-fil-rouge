<?php

require_once(__DIR__ . '/head.php');

if (
    !isset($_SESSION['LOGGED_USER'])
    || $_SESSION['LOGGED_USER']['role'] === 'customer'
) {
    redirectToUrl('read.php');
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
    'match_id' => 0,
]);

logAction('creation', ['titre' => $titre, 'auteur' => $auteur]);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Ajout dans la BDD</title>
</head>
<body class="container flex-column min-vh-100">
    <div class="container">
        <h1>Article ajouté avec succès !</h1>

        <div class="card">
            <div class="card-body">
                <h5 class="card-tittle"><?= htmlspecialchars(truncateString($titre)); ?></h5>
                <p class="card-text"><b>Par <?= htmlspecialchars(truncateString($auteur)); ?></b></p>
                <p class="card-text"><?= htmlspecialchars(truncateString($contenu)); ?></p>
            </div>
        </div>

        <a class="btn btn-primary" role="button" href="read.php">RETOUR</a>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>
</html>