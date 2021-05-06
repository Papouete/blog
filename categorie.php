<?php

require 'functionsblog.php';

$pdo = getConnection();

$query = $pdo->prepare('
    SELECT title, content, firstname, lastname, creation_date
    FROM posts
    INNER JOIN users ON users.id = posts.author_id
    WHERE category_id = ?
');

$query->execute([
    $_GET['id']
]);

$articles = $query->fetchAll();



/******************************************/

$query = $pdo->prepare('
    SELECT name, categories.id AS ID, COUNT(title) AS nbArt
    FROM categories
    INNER JOIN posts ON categories.id = posts.category_id
    GROUP BY category_id
');

$query->execute(
);

$categorys = $query->fetchAll();





// Ficher phtml spéficique à la page 
$template = 'categorie';    // Le fichier index.phtml sera chargé directement dans le layout

// Chargement du layout qui va lui-même charger le template au bon endroit
require 'layout.phtml';