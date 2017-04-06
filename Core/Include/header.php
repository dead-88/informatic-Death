<?php
require_once '../Modelo/class.conection.php';
require_once '../Modelo/class.consultations.php';
require_once '../Controlador/loadArticles.php';

session_start();
$consult    = new Consultations();
$conection  = new Conection();
$connect    = $conection->get_conection();

if(!isset($_SESSION['usuario'], $_SESSION['id_user'])){
    header('location: ../../index.php');
}else{

    // Ver el registro completo del usuario que ingreso.
    $stm = $connect->prepare("SELECT * FROM `users` WHERE `users` = ?");
    $stm->execute(array($_SESSION['usuario']));
    $user = $stm->fetch();
    // Fin registros

    $conversations  = $consult->viewConversations();
    $conversationsA = $consult->viewConversationsAdmin();
    $rowspost       = $consult->viewPost();
    $allUsersOnline = $consult->viewUsersOnline();
    $usersCount     = count($allUsersOnline);
    $idPost         = count($rowspost);
    $MessageId      = count($conversations);
    $MessageIdA     = count($conversationsA);
    $maxMesj        = $MessageId + $MessageIdA;

    if(isset($conversations)){
        foreach($conversations as $conversation){}
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
    <link rel="icon" href="../../Views/app/Img/Informatic_Death_122051.jpg" style="icon: auto;align-self: baseline;">
    <title>Team Informatic-Death</title>
    <link rel="stylesheet" type="text/css" href="../../Views/app/Css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../../Views/app/Css/bootstrap-theme.min.css">
    <link rel="stylesheet" type="text/css" href="../../Views/app/Css/blog.css">
    <link rel="stylesheet" type="text/css" href="../../Views/app/Css/perfil.css">
    <link rel="stylesheet" href="../../Views/app/Css/font/flaticon.css" media="screen" title="no title" charset="utf-8">
    <link rel="stylesheet" href="../../Views/app/Css/usuarios.css">
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
                <a href="#Welcome" class="nav-tabs navbar-brand">We Are One!</a>
            </div>

            <!-- Inicio del menu -->
            <div class="collapse navbar-collapse" id="navegacion-fm">
                <ul class="nav navbar-nav">
                    <li><a href="index.php">Inicio</a></li>
                    <li class="dropdown">
                        <a href="#" class="btn-nw dropdown-toggle" data-toggle="dropdown" role="button">
                            Configuración<span class="flaticon-settings-4"></span>
                        </a>
                        <ul class="dropdown-menu pull-left" role="menu">
                            <li><a href="perfil.php" class="pull-right">Mí Cuenta<span class="flaticon-user"></span></a></li>
                            <li><a href="../Controlador/close.php" class="pull-right">Logout<span class="flaticon-power"></span></a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>