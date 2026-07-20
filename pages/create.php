<?php

    if (
    !isset($_SESSION['LOGGED_USER'])
    || $_SESSION['LOGGED_USER']['role'] === 'customer'
) {
    redirectToUrl('read.html');
}

?>

    <div class="container">
    
      <h1>Ajouter un article</h1>
    <form action="create-post.html" method="post">
        <div class="mb-3 d-flex flex-column">
            <label for="auteur" class="form-label">Auteur de l'article</label>
            <input type="text" class="form-control" id="auteur" name="auteur">
        </div>

        <div class="mb-3 d-flex flex-column">
            <label for="titre" class="form-label">Titre de l'article</label>
            <input type="text" class="form-control" id="titre" name="titre" aria-describedby="titre-help">
            <div id="titre-help" class="form-text text-primary-emphasis">Choisissez un titre percutant !</div>
        </div>

        <div class="mb-3 d-flex flex-column">
            <label for="contenu" class="form-label">Contenu de l'article</label>
            <textarea placeholder="Seulement du contenu vous appartennant ou libre de droits." id="contenu" name="contenu"></textarea>
        </div>
        
        <button type="submit" class="btn btn-primary mb-3">Envoyer</button>
        <br>
        <a class="btn btn-danger" role="button" href="read.html">RETOUR</a>
    </form>
    </div>
