<?php
$routeur = new AltoRouter();
$routeur->map('GET','/','home');
$routeur->map('GET|POST','/login','login');
$match = $routeur->match();
if(is_array($match)){
    $pageOk = true;
    $params = $match['params'];
    if($match['target'] == "home"){
        require 'templates/home.php';
    }else if($match['target'] == "login" && empty($_SESSION['isConnected'])){
        if(isset($_POST['submit'])){
            if(!empty($_POST['email'])){
                if(filter_var($_POST['email'],FILTER_VALIDATE_EMAIL)){
                    $emailLogin = htmlspecialchars($_POST['email']);
                    if(!empty($_POST['password'])){
                        $passwordLogin = htmlspecialchars($_POST['password']);
                        $_SESSION['isConnected'] = connectAdmin($emailLogin,$passwordLogin,$conn);
                        if($_SESSION['isConnected']){
                            header('location:/');
                        }
                    }else{
                        $_SESSION['flashMessage'] = "Mot de passe manquant !";
                        $_SESSION['flashColor'] = "danger";
                    }
                }else{
                    $_SESSION['flashMessage'] = "Le format de l'adresse email n'est pas valide !";
                    $_SESSION['flashColor'] = "danger";
                }
            }else{
                $_SESSION['flashMessage'] = "Adresse email manquante !";
                $_SESSION['flashColor'] = "danger";
            }
        }
        require 'templates/login/loginTemplate.php';
    }else{
        $_SESSION['flashMessage'] = "Vous êtes déja connecté !";
        $_SESSION['flashColor'] = "success";
        require 'templates/errors/errorLogin.php';
    }
}else{
    $pageOk = false;
}