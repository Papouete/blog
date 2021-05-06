<?php

require 'functionsblog.php';

$pdo = getConnection();

$query = $pdo->prepare('
    SELECT COUNT(title) AS totalposts
    FROM posts
');

$query->execute();

$results = $query->fetch();

$resultsPerPage = 4;
$totalPages = ceil($results['totalposts'] / $resultsPerPage);

if (isset($_GET['page'])) {
    $page = $_GET['page'];
} else {
    // Page par défaut quand aucune page n'est stipulée dans l'url
    $page = 1;
}

$offset = ($page - 1) * $resultsPerPage;

/************************************************************/

$query = $pdo->prepare("
    SELECT title, content, firstname, lastname, creation_date
    FROM posts
    INNER JOIN users ON users.id = posts.author_id
    ORDER BY creation_date
    LIMIT $resultsPerPage OFFSET $offset
");

$query->execute();

$articles = $query->fetchAll();


/*********************************/

// AFFICHE LA LISTE DES CATEGORIES
$query = $pdo->prepare('
    SELECT name, categories.id AS ID, COUNT(title) AS nbArt
    FROM categories
    INNER JOIN posts ON categories.id = posts.category_id
    GROUP BY category_id
');

$query->execute(
);

$categorys = $query->fetchAll();

/************************************************************** PAGINATION */



// Ficher phtml spéficique à la page 
$template = 'index';    // Le fichier index.phtml sera chargé directement dans le layout

// Chargement du layout qui va lui-même charger le template au bon endroit
require 'layout.phtml';