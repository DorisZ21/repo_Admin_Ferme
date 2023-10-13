<?php
$routeur->map('GET','/delivery/show','deliveryShow');
$match = $routeur->match();
if(is_array($match)){
    $pageOk = true;
    $params = $match['params'];
    if($match['target'] == "deliveryShow"){
        if(isset($_SESSION['isConnected'])){
            $deliveries = selectAllDelivery($conn);
            require 'templates/delivery/deliveryShowTemplate.php';
        }else{
            $_SESSION['flashMessage'] = "Cette page est réservé aux admins";
            $_SESSION['flashColor'] = "danger";
            require 'templates/errors/errorNotLogin.php';
        }
    }
}else{
    $pageOk = false;
}


/*
$uri = $_SERVER['REQUEST_URI'];

if(isset($_SESSION['isConnected'])){
    if($_SESSION['isConnected']){
        if($uri == "/fermNathV2/index.php?/delivery/show"){
            $deliveries = selectAllDelivery($conn);
            require_once 'templates/delivery/deliveryShowTemplate.php';
        }elseif ($uri == "/fermNathV2/index.php?/delivery/Add"){
            if(!empty($_POST['titled'])){
                $titled = htmlspecialchars($_POST['titled']);
                if(!empty($_POST['date'])){
                    $date = htmlspecialchars($_POST['date']);
                    $statut = addDelivery($conn,$titled,$date);
                    if($statut){
                        $_SESSION['flashMessage'] = "Livraison ajouté avec succès !";
                        $_SESSION['flashColor'] = "success";
                        header('Location:index.php?/delivery/show');
                    }
                }
            }
            require_once 'templates/delivery/deliveryAddTemplate.php';
        }elseif (isset($_GET['idDelivery'])){
            $idDelivery = htmlspecialchars($_GET['idDelivery']);
            $resultDeliveryUpd = selectOneDelivery($conn,$idDelivery);   
            require_once 'templates/delivery/deliveryUpdateTemplate.php';
        }
    }else{
        header('Location:index.php?/login');
    }
}*/