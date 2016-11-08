<?php
require_once '../Modelo/class.conection.php';
require_once '../Modelo/class.consultations.php';
require_once '../Controlador/loadArticles.php';

session_start();
if(!isset($_SESSION['usuario'])){
    header('location:../index.php');
}else{
    $modelo = new Consultations();
    $conversations = $modelo->viewConversations();
    if(isset($conversations)){
        foreach($conversations as $conversation){}
    }
    $modelo = new Consultations();
    $conversationsId = $modelo->viewConversationsId();
    if(isset($conversationsId)){
        foreach($conversationsId as $MessageId){}
    }

    $modelo = new Consultations();
    $users = $modelo->viewUsers();
    if(isset($users)){
        foreach($users as $user){}
    }

    $modelo = new Consultations();
    $rowspost = $modelo->viewPost();
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
    <title>Hacking Cracking & More...</title>
    <link rel="stylesheet" type="text/css" href="../Views/app/Css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../Views/app/Css/bootstrap-theme.min.css">
    <link rel="stylesheet" type="text/css" href="../Views/app/Css/blog.css">
    <link rel="stylesheet" href="../Views/app/Css/font/flaticon.css" media="screen" title="no title" charset="utf-8">
</head>
<body>

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
                                <li><a href="../Controlador/close.php" class="pull-right">Sign Out <span class="flaticon-power"></span></a></li>
                                <li><a href="#" class="pull-right">My account<span class="flaticon-user"></span></a></li>
                            </ul>
                        </li>
                    </li>
                </ul>

                <form class="navbar-form navbar-collapse" role="form">
                    <div class="form-group">
                        <input name="search" type="text" class="form-control" placeholder="Buscar...">
                    </div>
                    <button type="submit" class="btn btn-primary">
                        <span class="glyphicon glyphicon-search"></span>
                    </button>
                </form>
            </div>
        </div>
    </nav>
</header>

<section class="jumbotron">
    <div class="container">
        <h2 class="titulo text-capitalize"><img src="../Views/app/Img/default.jpg" alt="default" class="thumb pull-left img-circle"><?php echo $_SESSION['usuario'];?></h2>
        <p class="text-left">Divertamonós Juntos <span>Informatic-Death...!</span></p>
    </div>
    <div class="clearfix"></div>
</section>

<section class="main container">
    <?php

    if(isset($_GET['search'])){
        search($_GET['search']);
    }else{
        viewPost();
    }
    ?>
</section>

    <center>
        <nav>
            <div class="center-block">
                <ul class="pagination">
                    <li><a href="#">&laquo;<span class="sr-only">Anterior</span></a></li>
                    <li class="active"><a href="#">1</a></li>
                    <li><a href="#">2</a></li>
                    <li><a href="#">3</a></li>
                    <li><a href="#">4</a></li>
                    <li><a href="#">5</a></li>
                    <li><a href="#">&raquo;<span class="sr-only">Siguiente</span></a></li>
                </ul>
            </div>
        </nav>
    </center>

<section class="main container">
    <div class="row">
        <section class="posts col-md-9">
            <div class="row">
                <h1 class="well text-center text-danger">Conversación De Hackers...!</h1>
                <p class="flaticon-document"> Comentariós: <?php if(isset($MessageId)){echo $MessageId[0];}; ?></p>
                <form id="formChat" role="form">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12">
                                <div id="conversation">

                                </div>
                            </div>
                        </div>
                    </div>
            </div>
            <div class="hidden">
                <label for="user" class="text-center">Usuario:</label>
                <input type="text" class="form-control" id="user" name="user" value="<?php echo $_SESSION['usuario']; ?>" required>
            </div>
            <div class="form-group">
                <label for="message" class="text-center">Message:</label>
                <textarea name="message" id="message" placeholder="Enter message..." class="form-control" role="textbox" required></textarea>
            </div>
            <input type="submit" class="btn btn-primary" id="send">
            </form>
        </section>

        <aside class="col-md-3 hidden-xs hidden-sm">
            <h4 class="text-center">Proximós cursos esperalos...</h4>
            <div class="list-group">
                <a href="#" class="list-group-item">Diseño Web</a>
                <a href="#view" class="list-group-item view">Php</a>
                <div class="obj">
                    Quieres aprender Php en pocos pasos? facil, solo tienes que darle <a href="#">ME GUSTA</a> y subscribirse en
                    nuestro canál de <a href="#">YouTube.</a>
                    <p class="text-justify">Te enseñare a crear un CRUD orientado a objetos desde cero con  MYSQL y PHP (CRUD with PDO)</p>
                </div>
                <a href="#" class="list-group-item">JavaScript</a>
                <a href="#" class="list-group-item">Css</a>
                <a href="#" class="list-group-item">Css3</a>
                <a href="#" class="list-group-item">Html5</a>
                <a href="#" class="list-group-item">JQuery</a>
                <a href="#" class="list-group-item view">MySql + SQL</a>
            </div>
            <h4 class="text-center">Noticias Recientes</h4>
            <a href="#" class="list-group-item">
                <h4 class="list-group-item-heading">Inicia tu proyecto</h4>
                <p class="list-group-item-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Alias consectetur eius, iusto qui soluta voluptate. Amet dolorem eaque enim labore minima nam neque quaerat reprehenderit, voluptatum? Ad autem excepturi nam.</p>
            </a>
            <h4 class="text-center">Videos</h4>
            <div class="list-group list-video">

            </div>
        </aside>
    </div>

</section>

<footer>
    <div class="container">
        <div class="row">
            <div class="color-footer col-xs-6">
                <p>Copyright &COPY; <?php echo date("Y"); ?> Create By Dead_*88 & InformaticDeath</p>
            </div>
            <div class="col-xs-6">
                <ul class="list-inline text-right">
                    <li><a href="#">Inicio</a></li>
                    <li><a href="#">Categorias</a></li>
                    <li><a href="#">Cursos</a></li>
                </ul>
            </div>
        </div>
    </div>
</footer>
<script type="text/javascript" src="../Views/app/Js/jquery-1.12.4.min.js"></script>
<script type="text/javascript" src="../Views/app/Js/bootstrap.min.js"></script>
<script type="text/javascript" src="../Views/app/Js/index.js"></script>
<script type="text/javascript" src="../Views/app/Js/ajax.js"></script>
</body>
</html>
