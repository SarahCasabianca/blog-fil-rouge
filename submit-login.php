<?php

// Démarre la session qui stocke les informations de connexion
session_start();

// Inclus la bdd et les fonctions
require(__DIR__ . '/connect.php');
require(__DIR__ . '/functions.php');

// Je récupère les données du formulaire et les stocke dans $postData
$postData = $_POST;

// Vérifie que les champs du formulaire existent bien
if (isset($postData['email']) && isset($postData['mdp'])) {

    // Validation du format de l'email
    if (!filter_var($postData['email'], FILTER_VALIDATE_EMAIL)) {
        $_SESSION['LOGIN_ERROR_MESSAGE'] = 'Email non valide';
    }
    else {
        // On cherche l'abonné dont l'email ET le mot de passe correspondent
        foreach ($abonnes as $user) {
            if (
                $user['mail'] === $postData['email'] &&
                password_verify($postData['mdp'], $user['password'])
            ) {
                // Authentification réussie : on stocke ses infos en session (jamais le mot de passe !)
                $_SESSION['LOGGED_USER'] = [
                    'email'  => $user['mail'],
                    'nom'    => $user['nom'],
                    'prenom' => $user['prenom'],
                    'role'   => $user['role'],
                ];
            }
        }

        // Si après la boucle personne n'a matché : identifiants incorrects
        if (!isset($_SESSION['LOGGED_USER'])) {
            $_SESSION['LOGIN_ERROR_MESSAGE'] = 'Email ou mot de passe incorrect.';
        }
    }

    // Dans tous les cas (succès ou échec), retour à la liste des articles
    redirectToUrl('read.php');
}