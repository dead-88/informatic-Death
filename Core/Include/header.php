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
    $user = $consult->session();
    // Fin registros

    $conversations  = $consult->viewConversations();
    $rowspost       = $consult->viewPost();
    $allUsersOnline = $consult->viewUsersOnline();
    $usersCount     = count($allUsersOnline);
    $idPost         = count($rowspost);

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
    <title>Team Informatic-Free</title>
    <link rel="stylesheet" type="text/css" href="../../Views/app/Css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../../Views/app/Css/bootstrap-theme.min.css">
    <link rel="stylesheet" type="text/css" href="../../Views/app/Css/font/flaticon.css" media="screen" title="informatic-Free" charset="utf-8">
    <link rel="stylesheet" type="text/css" href="../../Views/app/Css/font/font-awesome.min.css" media="screen" title="informatic-Free" charset="utf-8">
    <link rel="stylesheet" type="text/css" href="../../Views/app/Css/usuarios.css">
    <link rel="stylesheet" type="text/css" href="../../Views/app/Css/compiled.css">
    <link rel="stylesheet" type="text/css" href="../../Views/app/Css/mdb.css">
    <link rel="stylesheet" type="text/css" href="../../Views/app/Css/blog.css">
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

<header class="ltk-header">
    <div class="container">
    <?php 

        if(isset($user[0]['foto_user']) == null || $user[0]['foto_user'] == ""){
            echo '<img src="../../Views/app/Img/aggUser.png" alt="Error" class="hide-xs pull-left img-responsive avatar">';
        }else{
            echo '<img src="data:image/*;base64,'.base64_encode($user[0]['foto_user']).'" alt="Error" class="hide-xs pull-left img-responsive avatar">';
        }

     ?>
        <h1>
            <a href="Usuarios.php?id_users=<?php echo $user[0]['id_users'];?>"><?php echo strtoupper($user[0]['users']);?></a>
                <small>Programador. Desarrollador web y SEO de Informatic-Free</small>
        </h1>
    </div>

    <nav class="navbar navbar-default ltk-navbar-primary" role="navigation">
        <div class="container">

            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse-primary">
                    <span class="sr-only">Menú</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>

            <div class="collapse navbar-collapse" id="navbar-collapse-primary">
                <ul class="nav navbar-nav">
                    <li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-home menu-item-4">
                        <a title="Inicio" href="index.php">Inicio</a>
                    </li>
                    <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-412">
                        <a title="Artículos" href="">Artículos</a>
                    </li>
                    <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-658">
                        <a title="Cursos" href="">Cursos</a>
                    </li>
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