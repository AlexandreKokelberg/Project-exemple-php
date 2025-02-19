<?php

function createUser($pdo)
{
    try {
        $query = 'insert into utilisateurs(nomUser, prenomUser, loginUser, passWordUser, role, emailUser) values (:nomUser, :prenomUser, :loginUser, :passWordUser, :role, :emailUser)';
        $ajouteUser = $pdo->prepare($query);
        $ajouteUser->execute([
            'nomUser' => $_POST["nom"],
            'prenomUser' => $_POST["prenom"],
            'loginUser' => $_POST["login"],
            'passWordUser' => $_POST["mot_de_passe"],
            'emailUser' => $_POST["email"],
            'role' => 'user'
            ]);   
    } catch (PDOException $e) {
        $message = $e->getMessage();
        die($message);
    }
}
function connectUser($pdo)
{
    try {
        $query = 'select * from utilisateurs where loginUser = :loginUser and passWordUser = :passWordUser';
        $connectUser = $pdo->prepare($query);
        $connectUser->execute([
            'loginUser' => $_POST["login"],
            'passWordUser' => $_POST["mot_de_passe"]
        ]);
        $user = $connectUser->fetch();
        if (!$user) {
            return false;
        }
        else{
            $_SESSION["user"] = $user;
            return true;
        }
    } catch (PDOException $e) {
        $message = $e->getMessage();
        die($message);
    }
}
function updateUser($pdo)
{
    try {
        $query = 'update utilisateurs set nomUser = :nomUser, prenomUser = :prenomUser, passWordUser = :passWordUser, emailUser = :emailUser where id = :id';
        //préparation de la requête
        $ajouteUser = $pdo->prepare($query);
        //exécution en attribuant les valeurs récupérées dans le formulaire aux paramètres
        $ajouteUser->execute([
            'nomUser' => $_POST["nom"],
            'prenomUser' => $_POST["prenom"],
            'passWordUser' => $_POST["mot_de_passe"],
            'emailUser' => $_POST["email"],
            'id' => $_SESSION["user"]->id //récupérationde l'id de l'utilisateur en session actuellement connecté
        ]);
    } catch (PDOEXECEPTION $e) {
        $message = $e->getMessage();
        die($message);
    }
}
function updateSession($pdo)
{
    try {
        $query = 'select * from utilisateurs where id = :id';
        $selectUser = $pdo->prepare($query);
        $selectUser->execute([
            'id' => $_SESSION["user"]->id //récupération de l'id de l'utilisateur en session actuellement conecté
        ]);
        $user = $selectUser->fetch(); //pas fetchAll car on ne veut qu'un ligne !
        $_SESSION["user"] = $user;
    } catch (PDOException $e) {
        $message = $e->getMessage();
        die($message);
    }
}