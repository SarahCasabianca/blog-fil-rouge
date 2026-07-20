<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <title>Passion Foot</title>
</head>
<body>

<div class="container d-flex flex-row justify-content-between align-items-center my-5">

    <!-- Zone logo et titre (colonne de gauche) -->
    <div class="col-4">
        <a href="<?= BASE_URL ?>/" class="text-decoration-none">
            <h4>⚽ PASSION FOOT</h4>
        </a>

        <?php if (isset($_SESSION['LOGGED_USER'])) : ?>
            Bonjour <?= htmlspecialchars($_SESSION['LOGGED_USER']['prenom']); ?> —
        <?php endif; ?>

        Édition du <?php echo date("d/m/Y") ?>
    </div>

    <!-- Menu de navigation (colonne de droite) -->
    <div class="col-8 text-end">
        <ul class="list-inline">
            <li class="list-inline-item">
                <a href="<?= BASE_URL ?>/">Accueil</a>
            </li>
        </ul>
    </div>
</div>