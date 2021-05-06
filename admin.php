<?php

require 'functionsblog.php';

$pdo = getConnection();



if(!empty($_POST['sup'])){
//     $query = $pdo->prepare('
//     DELETE FROM comments WHERE post_id = ?
//     ');

//     $query->execute([
//         $_POST['supComment']
// ]);
    
    $query = $pdo->prepare('
    DELETE FROM posts WHERE title = ?
    ');

    $query->execute([
        $_POST['sup']
]);


} 



$query = $pdo->prepare('
    SELECT title, content, creation_date, firstname, lastname, name, posts.id AS POSTid
    FROM posts
    INNER JOIN users ON users.id = posts.author_id
    INNER JOIN categories ON posts.category_id = categories.id
    ORDER BY creation_date
');

$query->execute();

$articles = $query->fetchAll();





$template = 'admin';
require "layout.phtml";