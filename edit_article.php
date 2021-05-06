<?php

require 'functionsblog.php';

$pdo = getConnection();

$query = $pdo->prepare('
    SELECT title, content, firstname, lastname, creation_date 
    FROM posts
    INNER JOIN users ON users.id = posts.author_id
    WHERE posts.id = ?
');

$query->execute([
    $_GET['thisID']
]);

$article = $query->fetch();



/************************ MODIFIER LE OCNTENU DE L ARTICLE SELECTIONEE *********************/
if (!empty($_POST['modif_content'])){
    
    $query = $pdo->prepare('
        UPDATE posts SET title = ?, content = ? 
        WHERE id = ?
    ');
    
    $query->execute([
        $_POST['modif_title'],
        $_POST['modif_content'],
        $_GET['thisID']
    ]);
    
    header('Location: index.php');
    exit();
}








// Ficher phtml spéficique à la page 
$template = 'edit_article';    // Le fichier index.phtml sera chargé directement dans le layout

// Chargement du layout qui va lui-même charger le template au bon endroit
require 'layout.phtml';