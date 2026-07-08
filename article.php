<?php

include('connect.php');

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $articleId = $_GET['id'];

$articleId = $_GET['id'];


$sqlQuery = '
    SELECT a.id, a.titre, a.contenu, a.date_publication, r.score, r.lieu
        FROM articles_presse a
        LEFT JOIN resultats_sportifs r ON a.match_id = r.id
        ORDER BY `a`.`date_publication`
        DESC;';

$statement = $mysqlClient->prepare($sqlQuery);
$statement->bindParam(':id', $articleId, PDO::PARAM_INT);
$statement->execute();
$article = $statement->fetch();

$truncatedContent = substr($article['contenu'], 0, 50) . '';

?>



<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Article du match</title>
</head>
<body>
    <div class="container">
        <h1 class="text-primary text-center">PASSION FOOT</h1><hr>

        <div class="row">

            <div class="d-flex flex-row justify-content-center justify-content-md-end">
            <a type="button" class="btn btn-primary text-white me-3" href="create.php">Ajouter un article</a>
            </div>
            

            <div class="col-12 col-md-4 d-flex justify-content-center g-3">
                <div class="card" style="width: 24rem;">
                    <img src="https://picsum.photos/200/150" class="card-img-top " alt="">
                    <h5 class="card-header"><?= htmlspecialchars(truncateString($article['titre'], 30)); ?></h5>
                    <div class="card-body">
                        <p class="card-text"><strong>ID de l'article : </strong><?= htmlspecialchars($article['id']); ?></p>
                        (lieu : <?= htmlspecialchars($article['lieu'] ?? 'Il n\'y a pas de lieu'); ?>)

                        <p class="card-text"><?= htmlspecialchars(truncateString($article['contenu'], 100)); ?></p>

                        <p class="card-text"><?= htmlspecialchars($article['textequejeveux']); ?></p>
                    </div>
                    <div class="card-footer p-3 g-3">
                        <a type="button" class="btn btn-primary text-white m-2" href="<?= htmlspecialchars('update.php?id=' . $article['id']); ?>">Modifier l'article</a>
                        <a type="button" class="btn btn-danger text-white m-2" href="<?= htmlspecialchars('delete.php?id=' . $article['id']); ?>">Supprimer l'article</a>
                        <a type="button" class="btn btn-secondary text-white m-2" href="<?= htmlspecialchars('article.php?id=' . $article['id']); ?>">Ouvrir l'article</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</body>
</html>