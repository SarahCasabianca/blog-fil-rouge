<div class="container d-flex flex-row justify-content-between align-items-center my-5">

    <!-- Zone logo et titre (colonne de gauche) -->
    <div class="col-4">
        <!-- Logo cliquable qui renvoie à l'accueil (-->
        <a href="read.php" class="text-decoration-none">
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
                <a href="read.php">Accueil</a>
            </li>
            <?php if (isset($_SESSION['LOGGED_USER']) && ($_SESSION['LOGGED_USER']['role'] === 'owner' || $_SESSION['LOGGED_USER']['role'] === 'admin')) : ?>
                <li class="list-inline-item">
                    <a href="create.php">Ajouter un article</a>
                </li>
            <?php endif; ?>
        </ul>
    </div>
</div>