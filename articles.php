<?php

require 'functionsblog.php';

$pdo = getConnection();

if (!empty($_POST)) {
        $query = $pdo->prepare('
        INSERT INTO comments (username, content, post_id, creation_date) VALUES (?, ?, ?, NOW())
        ');
    
            $query->execute([
                $_POST['pseudo'],
                $_POST['comentaire'],
                $_POST['POSTid'],
            ]);
}

/****************************************************/

$query = $pdo->prepare('
    SELECT title, content, firstname, lastname, creation_date, posts.id as POSTid
    FROM posts
    INNER JOIN users ON users.id = posts.author_id
    WHERE title = ?
');

$query->execute([
    $_GET['title']
]);

$article = $query->fetch();


/************************************************/

$query = $pdo->prepare('
    SELECT username, comments.content, comments.creation_date
    FROM comments
    INNER JOIN posts ON comments.post_id = posts.id
    WHERE title = ?
');

$query->execute([
    $_GET['title']
]);

$comments = $query->fetchAll();


/*****************************************************/




$template = 'articles';
require "layout.phtml";