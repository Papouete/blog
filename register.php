<?php

require 'functionsblog.php';

$pdo = getConnection();


if (!empty($_POST)) {
    
    $query = $pdo->prepare('
        INSERT INTO users (email, password, firstName, lastName) VALUES (?, ?, ?, ?)
    ');
    
    $query->execute([
        $_POST['email'],
        password_hash($_POST['password'], PASSWORD_BCRYPT),
        $_POST['firstName'],
        $_POST['lastName']
    ]);
    header('Location: index.php');
    exit();
};
    






// Ficher phtml spéficique à la page 
$template = 'register';    // Le fichier index.phtml sera chargé directement dans le layout

// Chargement du layout qui va lui-même charger le template au bon endroit
require 'layout.phtml';