<?php

$host = 'sarahcrsport2000.mysql.db'; // mettre url de votre Serveur OVH
$dbname = 'sarahcrsport2000';
$username = 'sarahcrsport2000';
$password = '';
$port = 3306;

// rappel, en ovh start/perso vous n'avez qu'une seule DB. 
// alors bien nommer votre projet avec un préfixe :
// blabla_cinema_users
// blabla_cinema_movies

try {
    $mysqlClient = new PDO("mysql:host=$host;port=$port;dbname=$dbname", $username, $password);
    $mysqlClient->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}