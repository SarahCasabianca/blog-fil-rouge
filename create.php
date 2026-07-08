<?php

    require_once(__DIR__ . '/head.php');

?>

<!DOCTYPE html>
<html lang="fr">
<head>  
    <title>Ajout d'article</title>
</head>
<body class="d-flex flex-column min-vh-100">
    <div class="container">
    
      <h1>Ajouter un article</h1>
    <form action="create-post.php" method="post">
        <div class="mb-3 d-flex flex-column">
            <label for="auteur" class="form-label">Auteur de l'article</label>
            <input type="text" class="form-control" id="auteur" name="auteur">
        </div>

        <div class="mb-3 d-flex flex-column">
            <label for="titre" class="form-label">Titre de l'article</label>
            <input type="text" class="form-control" id="titre" aria-describedby="titre-help">
            <div id="titre-help" class="form-text text-primary-emphasis">Choisissez un titre percutant !</div>
        </div>

        <div class="mb-3 d-flex flex-column">
            <label for="contenu" class="form-label">Contenu de l'article</label>
            <textarea name="form-control" placeholder="Seulement du contenu vous appartennant ou libre de droits." id="contenu" name="contenu"></textarea>
        </div>
        
        <button type="submit" class="btn btn-primary mb-3">Envoyer</button>
        <br>
        <a class="btn btn-danger" role="button" href="read.php">RETOUR</a>
    </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>
</html>