<?php

require_once(__DIR__ . '/head.php');

if (isset($_GET['id']) && is_numeric($_GET['id'])) {

    $articleId = $_GET['id'];

    // Requête ciblée : UN article via son id (LEFT JOIN pour le match éventuel)
    $sqlQuery = '
        SELECT a.id, a.titre, a.contenu, a.date_publication, r.score, r.lieu
        FROM articles_presse a
        LEFT JOIN resultats_sportifs r ON a.match_id = r.id
        WHERE a.id = :id';

    $statement = $mysqlClient->prepare($sqlQuery);
    $statement->bindParam(':id', $articleId, PDO::PARAM_INT);
    $statement->execute();
    $article = $statement->fetch();
}

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <title>PASSION FOOT | <?= isset($article['titre']) ? htmlspecialchars($article['titre']) : 'Article'; ?></title>
</head>
<body>
    <div class="container text-center d-flex flex-wrap justify-content-center">

    <?php if (isset($article) && $article) : ?>

        <div class="card col-9 m-5 p-3">
            <?php
            // Image de l'article si elle existe, sinon image de repli
            $imagePath = 'img/' . $article['id'] . '.jpg';
            $image = file_exists($imagePath) ? $imagePath : 'https://picsum.photos/800/150';
            ?>
            <img src="<?= htmlspecialchars($image); ?>" class="img-fluid rounded-top mb-2" alt="<?= htmlspecialchars($article['titre']); ?>">

            <h1><?= htmlspecialchars($article['titre']); ?></h1>
            <p>Date : <?= htmlspecialchars($article['date_publication']); ?></p>

            <?php if ($article['score']) : ?>
                <strong style="color:#FF0000">score : <?= htmlspecialchars($article['score']); ?></strong>
            <?php endif; ?>

            <?php if ($article['lieu']) : ?>
                <p>lieu : <?= htmlspecialchars($article['lieu']); ?></p>
            <?php endif; ?>

            <!-- Contenu COMPLET : pas de truncateString sur une page de détail ! -->
            <p><?= htmlspecialchars($article['contenu']); ?></p>
        </div>

        <div class="col-12 mb-4">
            <button id="shareButton" class="btn btn-secondary"
                data-title="<?= htmlspecialchars($article['titre']); ?>"
                data-url="article.php?id=<?= (int)$article['id']; ?>">Partager</button>

            <a class="btn btn-primary" role="button" href="../read.php">RETOUR</a>
            <div id="shareAlert"></div>
        </div>

        <script>
            document.getElementById('shareButton').addEventListener('click', async (e) => {
                const btn = e.currentTarget;
                try {
                    await navigator.share({ title: btn.dataset.title, url: btn.dataset.url });
                } catch {
                    document.getElementById('shareAlert').textContent = 'Partage indisponible (nécessite HTTPS ou un navigateur compatible).';
                }
            });
        </script>

    <?php elseif (isset($article)) : ?>
        <div class="card m-5 p-5"><p>Article non trouvé.</p><a href="read.php">RETOUR</a></div>
    <?php else : ?>
        <div class="card m-5 p-5"><p>Identifiant d'article manquant ou invalide.</p><a href="read.php">RETOUR</a></div>
    <?php endif; ?>

    </div>
    <?php require_once(__DIR__ . '/footer.php'); ?>
</body>
</html>