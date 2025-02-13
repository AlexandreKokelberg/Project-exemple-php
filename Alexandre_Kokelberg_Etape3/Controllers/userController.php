<?php   // code php qui décide de ce qu'il faut donner comme valeur à la variable $template

// on ajoutera par la suite les require aux modèles
require_once("Models/userModel.php");
// récupération du chemin désiré
$uri = $_SERVER["REQUEST_URI"];
if ($uri === "/connexion") {
    if(isset($_POST['btnEnvoi'])){
        $erreur=false;
        if(connectUser($pdo)){ //j'ai oublié un "r"
            //redirection vers a page d'accueil
            header("location:/");
        }
        else {
            //cas d'erreur
            $erreur=true;
        }
    }
    $title = "Connexion";                  //titre à afficher dans l'onglet de la page du navigateur
    $template = "Views/Users/connexion.php";        //chemin vers la vue demandée
    require_once("Views/base.php");             //appel de la page de base qui sera remplie avec la vue demandée
}
elseif ($uri === "/deconnexion") {      // on anticipe pour la suite
    session_destroy();
    header("location:/");
}
elseif ($uri ==="/inscription") {
    if(isset($_POST['btnEnvoi'])){
        // vérification des données encodées
        $messageError = verifyEmptyData();
        // s'il n'y a pas d'erreur
        if(!$messageError){
            // ajout de l'utilisateur à la base de données
            createUser($pdo);
            //redirection vers la page de connexion
            header('location:/connexion');
        }
    }
    $title = "Inscription";                  //titre à afficher dans l'onglet de la page du navigateur
    $template = "Views/Users/inscriptionOrEditProfile.php";        //chemin vers la vue demandée
    require_once("Views/base.php");             //appel de la page de base qui sera remplie avec la vue demandée
}
elseif ($uri === "/updateProfil") {
    $title = "Mise à jour du profil";
    $template = "Views/Users/inscriptionOrEditProfile.php";
    require_once("Views/base.php");
}
function verifyEmptyData()
{
    foreach ($_POST as $key => $value) {
        if (empty(str_replace(' ','',$value))){
            $messageError[$key] = "Votre" . $key . "est vide.";
        }
    }
    if (isset($messageError)) {
        return $messageError;
    } else {
        return false;
    }
}