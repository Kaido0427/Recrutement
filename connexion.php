<?php

$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'recrutementdb';


$connexion = new mysqli($servername, $username, $password, $dbname);

if (!$connexion) {
    die('Erreur survenur lors de la connexion à la base de données!' . $connexion->connect_error);
}