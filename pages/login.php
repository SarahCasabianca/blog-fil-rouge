<?php

if (!isset($_SESSION['LOGGED_USER'])) :

?>

<div class="card col-12 col-md-4 p-3">
    <form action="submit-login.html" method="POST">
        <?php if (!empty($_SESSION['LOGIN_ERROR_MESSAGE'])) : ?>
    <div class="alert alert-danger" role="alert">
        <?php
        echo htmlspecialchars($_SESSION['LOGIN_ERROR_MESSAGE']);
        unset($_SESSION['LOGIN_ERROR_MESSAGE']);
        ?>
    </div>
<?php endif; ?>
<!-- Email --> 
        <div class="mb-3">
            <h2>Vous voulez lire plus? Abonnez-vous :</h2>
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" required
                    aria-describedby="email-help" placeholder="email@exemple.com">
                    <div id="email-help" class="form-text">L'email utilisé lors de la création de compte.</div>
        </div>
        <!-- Mot de passe --> 
        <div class="mb-3">
            <label for="mdp" class="form-label">Mot de passe</label>
            <input type="password" class="form-control" id="mdp" name="mdp" required>
        <!-- Bouton -->
         <button type="submit" class="btn btn-primary">Envoyer</button>
        </div>
    </form>
</div>

<?php endif; ?>