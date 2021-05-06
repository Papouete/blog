<?php

function getConnection(): PDO
{
    return new PDO(
        'mysql:host=home.3wa.io:3307;dbname=live-46_florianmor_blog;charset=UTF8', 
        'florianmor',
        '9b80ebceYTUxMTYwMTU1NmM4NzlkYzk3MTE0MWI5ac706e82', [
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ]
    );
}
