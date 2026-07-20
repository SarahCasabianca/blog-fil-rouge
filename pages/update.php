<?php

if (
    !isset($_SESSION['LOGGED_USER'])
    || $_SESSION['LOGGED_USER']['role'] === 'customer'
) {
    redirectToUrl('read.html');
}


$getData = $_GET;

if (!isset($getData['id']) || !is_numeric($getData['id'])) {
    echo ('Il faut un identifiant de news pour la modifier.');
    return;
};

$retrieveArticleStatement = $mysqlClient->prepare('SELECT titre, contenu FROM articles_presse WHERE id = :id');

$retrieveArticleStatement->execute([
    'id' => (int)$getData['id'],
]);

$article = $retrieveArticleStatement->fetch(PDO::FETCH_ASSOC);

if (!$article) {
    echo ('Article introuvable. Vérifiez l\'ID fourni.');
    return;
}

?>

    <div class="container">
        <h1>Mettre à jour : <?= htmlspecialchars($article['titre']); ?></h1>

        
        <form action="update-post.html" method="POST">
        <div class="mb-3 visually-hidden">
            <label for="id" class="form_label">Identifiant de la news</label>

            <input type="hidden" class="form-control" id="id" name="id" value="<?= htmlspecialchars($getData['id']); ?>">
        </div>

        <div class="mb-3">
            <label for="titre" class="form-label">Titre</label>

            <input type="text" class="form-control" id="titre" name="titre" aria-describedby="titre-help" value="<?= htmlspecialchars($article['titre']); ?>">
            <div id="titre-help" class="form-text text-primary-emphasis">Choisissez un titre percutant !</div>
        </div>

        <div class="mb-3">
            <label for="contenu" class="form-label">Contenu</label>

            <textarea class="form-control" placeholder="" id="contenu" name="contenu"><?= htmlspecialchars($article['contenu']); ?></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Envoyer</button>
        <a class="btn btn-danger" role="button" href="read.html">RETOUR</a>
        </form>
    </div>
