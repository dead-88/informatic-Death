<?php
require_once '../Modelo/class.conection.php';
require_once '../Modelo/class.consultations.php';

session_start();

$consult = new Consultations();
$conection = new Conection();
$connect = $conection->get_conection();



if(!isset($_SESSION['usuario'])){
    header('location: ../../index.php');
}else{
    // Array del usuario que ingreso
    $stm = $connect->prepare("SELECT * FROM users WHERE id_users = :uid");
    $stm->execute(array(":uid"=>$_SESSION['usuario']));
    $user = $stm->fetch(PDO::FETCH_ASSOC);

    $conversations = $consult->viewConversations();
    $rowspost = $consult->viewPost();
    $conversationsId = $consult->viewConversationsId();

    //Ver los mensajes de cada usuario
    $usersIdMsj = $user['users'];
    $idMessage = $connect->prepare("SELECT COUNT(message) FROM conversation WHERE user_name = '$usersIdMsj'");
    $idMessage->execute();
    $idMsj = $idMessage->fetch(PDO::FETCH_ASSOC);


    if(isset($idMsj)){
        foreach ($idMsj as $idMsjs){}
    }

    if(isset($conversations)){
        foreach($conversations as $conversation){}
    }

    if(isset($conversationsId)){
        foreach($conversationsId as $MessageId){}
    }

    if(isset($rowspost)){
        foreach($rowspost as $rows){}
    }
}
?>
<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title>Informatic-Death</title>
    <link rel="stylesheet" type="text/css" href="../../Views/app/Css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../../Views/app/Css/bootstrap-theme.min.css">
    <link rel="stylesheet" type="text/css" href="../../Views/app/Css/blog.css">
    <link rel="stylesheet" type="text/css" href="../../Views/app/Css/perfil.css">
    <link rel="stylesheet" href="../../Views/app/Css/font/flaticon.css" media="screen" title="no title" charset="utf-8">
</head>
<script>
    var time;

    function start() {
        time = setTimeout('location="../Controlador/close.php"',3600000);
    }

    function stop() {
        clearTimeout(time);
        time = setTimeout('location="../Controlador/close.php"',3600000);
    }
</script>
<body onload="start()" onkeypress="stop()" onclick="stop()">

<header>
    <nav class="navbar navbar-default navbar-static-top navbar-fixed-top" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navegacion-fm">
                    <span class="sr-only"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a href="#Welcome" class="nav-tabs navbar-brand">We Are One</a>
            </div>

            <!-- Inicio del menu -->
            <div class="collapse navbar-collapse" id="navegacion-fm">
                <ul class="nav navbar-nav">
                    <li class="active"><a href="index.php">Inicio</a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button">
                            Herramientas <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="#">Windows x86 x64</a></li>
                            <li><a href="#">Linux x86 x64</a></li>
                        </ul>
                    <li class="dropdown">
                        <a href="#" class="btn-nw dropdown-toggle" data-toggle="dropdown" role="button">
                            Configuración<span class="flaticon-settings-4"></span>
                        </a>
                        <ul class="dropdown-menu pull-left" role="menu">
                            <li><a href="perfil.php" class="pull-right">Mí Cuenta<span class="flaticon-user"></span></a></li>
                            <li><a href="../Controlador/close.php" class="pull-right">Logout<span class="flaticon-power"></span></a></li>
                        </ul>
                    </li>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>