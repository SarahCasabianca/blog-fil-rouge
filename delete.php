<?php

require_once(__DIR__ . '/head.php');

if (
    !isset($_SESSION['LOGGED_USER'])
    || $_SESSION['LOGGED_USER']['role'] !== 'admin'
) {
    redirectToUrl('read.php');
}

$getData = $_GET;

if (!isset($getData['id']) || !is_numeric($getData['id'])) {
    echo ('Il faut un identifiant pour supprimer un article.');
    return;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Supprimer un article</title>
</head>

<body class="d-flex flex-column text-center min-vh-100">
    <div class="container">

        <h1>Supprimer l'article ?</h1>

        <form action="delete-post.php" method="post">
            <div class="mb-3 visually-hidden">
                <label for="id" class="form-label">Voulez-vous supprimer l'article <?= $getData['id']; ?> <?= $getData['titre'] ?>  écrit par <?= $getData['auteur'] ?> ?</label>
                <input type="hidden" class="form-control" id="id" name="id" value="<?= $getData['id']; ?>">
            </div>

            <button type="submit" class="btn btn-danger">Oui</button>

            <a class="btn btn-primary" role="button" href="read.php">Non</a>
        </form>
        <br>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>
</html>