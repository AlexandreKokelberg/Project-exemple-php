<?php
// En cas d'eerreur, on affiche le message de l'erreur attrapée
try {
    $strConnection = "mysql:host=10.10.51.98;dbname=school";
    $pdo=new PDO($strConnection,"alexandre5t","root",[
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
    ]);
} catch (PDOException $e) {
    $message = $e->getMessage();
    die($message);
}