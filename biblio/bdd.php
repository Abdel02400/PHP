<?php
try {
$db = new PDO('mysql:host=localhost;dbname=biblio;charset=utf8', 'root', '1993Aruu');
}
catch (Exception $e) {
die('Connexion impossible');
}
?>
