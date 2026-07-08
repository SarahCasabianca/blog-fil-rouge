<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lecture des articles</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>
<body>
    <?php
    include('connect.php');
    $sqlQuery = '
    SELECT a.id, a.titre, a.contenu, a.date_publication AS textequejeveux, r.score, r.lieu
        FROM articles_presse a
        LEFT JOIN resultats_sportifs r ON a.match_id = r.id
        ORDER BY `a`.`date_publication`
        DESC;';

$newsFraiches = $mysqlClient->prepare($sqlQuery);
$newsFraiches->execute();

$news = $newsFraiches->fetchAll();

function truncateString($string, $length = 20)
{
    if (strlen($string) > $length) {
        return substr($string, 0, $length) . ' (...)';
    }
    return $string;
}

    ?>

    <div class="container">
        <h1 class="text-primary text-center">PASSION FOOT</h1><hr>

        <div class="row">

            <div class="d-flex flex-row justify-content-center justify-content-md-end">
            <a type="button" class="btn btn-primary text-white me-3" href="create.php">Ajouter un article</a>
            </div>

            <?php
            foreach ($news as $new) {
            ?>
            

            <div class="col-12 col-md-4 d-flex justify-content-center g-3">
                <div class="card" style="width: 24rem;">
                    <img src="https://picsum.photos/200/150" class="card-img-top " alt="">
                    <h5 class="card-header"><?= htmlspecialchars(truncateString($new['titre'], 30)); ?></h5>
                    <div class="card-body">
                        <p class="card-text"><strong>ID de l'article : </strong><?= htmlspecialchars($new['id']); ?></p>
                        (lieu : <?= htmlspecialchars($new['lieu'] ?? 'Il n\'y a pas de lieu'); ?>)

                        <p class="card-text"><?= htmlspecialchars(truncateString($new['contenu'], 100)); ?></p>

                        <p class="card-text"><?= htmlspecialchars($new['textequejeveux']); ?></p>
                    </div>
                    <div class="card-footer p-3 g-3">
                        <a type="button" class="btn btn-primary text-white m-2" href="<?= htmlspecialchars('update.php?id=' . $new['id']); ?>">Modifier l'article</a>
                        <a type="button" class="btn btn-danger text-white m-2" href="<?= htmlspecialchars('delete.php?id=' . $new['id']); ?>">Supprimer l'article</a>
                        <a type="button" class="btn btn-secondary text-white m-2" href="<?= htmlspecialchars('article.php?id=' . $new['id']); ?>">Ouvrir l'article</a>
                    </div>
                </div>
            </div>
            <?php
            }
            ?>
        </div>
    </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>  
</body>
</html>