<?php

if (!hasRole('admin')) {
    redirectToUrl('read.html');
}

$getData = $_GET;

if (!isset($getData['id']) || !is_numeric($getData['id'])) {
    echo ('Il faut un identifiant pour supprimer un article.');
    return;
}

?>

    <div class="container">

        <h1>Supprimer l'article ?</h1>

        <form action="delete-post.html" method="post">
            <div class="mb-3">
                <label for="id" class="form-label">Voulez-vous supprimer l'article n°<?= $getData['id']; ?> ?</label>
            </div>
            <div class="mb-3 visually-hidden">
                <input type="hidden" class="form-control" id="id" name="id" value="<?= $getData['id']; ?>">
            </div>

            <button type="submit" class="btn btn-danger">Oui</button>

            <a class="btn btn-primary" role="button" href="read.html">Non</a>
        </form>
        <br>
    </div>
