<?php

try {

    $mysqlClient = new PDO(
        'mysql:host=localhost;dbname=sport_2000;charset=utf8',  // DSN (Data Source Name) : informations de connexion
        'root',                                                   // Nom d'utilisateur MySQL (ici root = admin)
        ''  
    );

    $mysqlClient ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

}

catch (exception $e) {
    die('Erreur de connexion à la base de données : ' . $e->getMessage());
}


