<!DOCTYPE html>
<html lang="fr">
<head>
    <?php
    require_once(__DIR__ . '/head.php');
    ?>
    <title>Lecture des articles</title>
</head>
<body>
    <?php require_once(__DIR__ . '/header.php'); ?>

    <?php
    $sqlQuery = '
    SELECT a.id, a.titre, a.contenu, a.date_publication AS textequejeveux, r.score, r.lieu
        FROM articles_presse a
        LEFT JOIN resultats_sportifs r ON a.match_id = r.id
        ORDER BY `a`.`date_publication`
        DESC;';

    $newsFraiches = $mysqlClient->prepare($sqlQuery);
    $newsFraiches->execute();

    $news = $newsFraiches->fetchAll();
    ?>

    <div class="container">
        <h1 class="text-primary text-center">PASSION FOOT</h1><hr>

        <div class="row">

            <!-- Message flash de succès (Post-Redirect-Get) : écrit en session par les pages -post, affiché une seule fois ici -->
            <?php if (!empty($_SESSION['SUCCESS_MESSAGE'])) : ?>
                <div class="alert alert-success" role="alert">
                    <?php
                    echo htmlspecialchars($_SESSION['SUCCESS_MESSAGE']);
                    unset($_SESSION['SUCCESS_MESSAGE']);
                    ?>
                </div>
            <?php endif; ?>

            <?php require_once(__DIR__ . '/login.php'); ?>

            <div class="d-flex flex-row justify-content-center justify-content-md-end">
            <?php if (
                isset($_SESSION['LOGGED_USER'])
                && ($_SESSION['LOGGED_USER']['role'] === 'owner' || $_SESSION['LOGGED_USER']['role'] === 'admin')
            ) : ?>
                <a type="button" class="btn btn-primary text-white me-3" href="create.php">Ajouter un article</a>
            <?php endif; ?>
            </div>

            <?php
            // UNE seule boucle : le slug est calculé une fois par article, au début
            foreach ($news as $new) {
                $slug = slugify($new['titre']);
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
                        <?php if (isset($_SESSION['LOGGED_USER']) && ($_SESSION['LOGGED_USER']['role'] === 'owner' || $_SESSION['LOGGED_USER']['role'] === 'admin')) : ?>
                        <a type="button" class="btn btn-primary text-white m-2" href="<?= htmlspecialchars('update.php?id=' . $new['id']); ?>">Modifier l'article</a>
                        <?php endif; ?>

                        <?php if (isset($_SESSION['LOGGED_USER']) && ($_SESSION['LOGGED_USER']['role'] === 'admin')) : ?>
                        <a type="button" class="btn btn-danger text-white m-2" href="<?= htmlspecialchars('delete.php?id=' . $new['id']); ?>">Supprimer l'article</a>
                        <?php endif; ?>

                        <!-- URL SEO-friendly : /article/12-le-titre.html, réécrite vers article.php?id=12 par le .htaccess -->
                        <a type="button" class="btn btn-secondary text-white m-2" href="<?= htmlspecialchars('article/' . $new['id'] . '-' . $slug . '.html'); ?>">Ouvrir l'article</a>
                    </div>
                </div>
            </div>

            <?php
            } // fin du foreach
            ?>
        </div>
    </div>

    <?php require_once(__DIR__ . '/footer.php'); ?>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>  
</body>
</html>