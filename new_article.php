<?php

require 'functionsblog.php';

$pdo = getConnection();



if (!empty($_POST)) {
        $query = $pdo->prepare('
        INSERT INTO posts (title, content, author_id, category_id, creation_date) VALUES (?, ?, ?, ?, NOW())
        ');
    
            $query->execute([
                $_POST['title'],
                $_POST['content'],
                $_POST['author_id'],
                $_POST['category_id']
            ]);
            
        header('Location: ' . 'index.php');
        exit();            

} else {
        $query = $pdo->prepare('
        SELECT firstName, lastName, id
        FROM users
        ');
    
        $query->execute();
        
        $authors = $query->fetchAll();

/******************************/

        $query = $pdo->prepare('
            SELECT name, id
            FROM categories
        ');
        
        $query->execute();
        
        $categories = $query->fetchAll();
        }





$template = 'new_article';
require "layout.phtml";