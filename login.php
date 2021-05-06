<?php

require 'functionsblog.php';

$pdo = getConnection();

if (!empty($_POST)) {
        $query = $pdo->prepare('
            SELECT email, password, firstName, lastName
            FROM users
            WHERE email = ?
        ');
        
        $query->execute([
            $_POST['email']
        ]);

}
      




// Ficher phtml spéficique à la page 
$template = 'login';    // Le fichier index.phtml sera chargé directement dans le layout

// Chargement du layout qui va lui-même charger le template au bon endroit
require 'layout.phtml';