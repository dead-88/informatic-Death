<?php
    require_once '../Modelo/class.conection.php';
    require_once '../Modelo/class.consultations.php';
    require_once '../Controlador/loadArticlesRoot.php';

session_start();
if(!isset($_SESSION['root'])){
    header('location:../index.php');
}else{
    $modelo = new Consultations();
    $conversations = $modelo->viewUsers();
    if(isset($conversations)){
        foreach($conversations as $conversation){}
    }

    $modelo = new Consultations();
    $view = $modelo->viewAdmin();
    if(isset($view)){
        foreach($view as $views){}
    }
}
if(!isset($_SESSION['root'])){
    header('location:../index.php');
}else{
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
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title>Developers Hacking</title>
    <link rel="stylesheet" type="text/css" href="../Views/app/Css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../Views/app/Css/bootstrap-theme.min.css">
    <link rel="stylesheet" type="text/css" href="../Views/app/Css/blog.css">
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
                <a href="blog.php" class="nav-tabs navbar-brand">Futúros Hackers </a>
            </div>

            <!-- Inicio del menu -->
            <div class="collapse navbar-collapse" id="navegacion-fm">
                <ul class="nav navbar-nav">
                    <li class="active"><a href="blog.php">Inicio</a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button">
                            Herramientas <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="#">Windows x86 & x64</a></li>
                            <li><a href="#">Mac</a></li>
                            <li><a href="#">Linux x86 & x64</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="btn-nw dropdown-toggle pull-right" data-toggle="dropdown" role="button">
                            Configuración <span class="glyphicon glyphicon-console"></span>
                        </a>
                        <ul class="dropdown-menu pull-right" role="menu">
                            <li><a href="../Core/Controlador/close.php" class="text-danger">Cerrar sesion</a></li>
                            <li><a href="#">My account</a></li>
                        </ul>
                    </li>
                </ul>
                <form method="get" class="navbar-form navbar-collapse" role="search">
                    <div class="form-group">
                        <input type="text" value="" class="form-control" name="search" id="valor" placeholder="Buscar...">
                    </div>
                    <button type="submit" class="btn btn-primary">
                        <span class="glyphicon glyphicon-search"></span>
                    </button>
                    <div class="resultados" id="resultados"></div>
                </form>
            </div>
        </div>
    </nav>
</header>

<section class="jumbotron">
    <div class="container">
        <h1 class="titulo text-capitalize"><span class="glyphicon glyphicon-user"></span><?php echo $views['user_admin'] ?></h1>
        <p>Panel De Administración <span>Bienvenido/a</span></p>
        <p class="text-right">My IP Global [---> <?php echo $views['ip'] ?> <---]</p>
    </div>
</section>

    <?php

    if(isset($_GET['search'])){
        search($_GET['search']);
    }else{
        viewPostAdmin();
    }
    ?>

<section class="main container">
    <div class="row">

        <section class="posts col-md-9">

            <article class="post clearfix">
                <br>
                <form action="../Core/Controlador/registerPost.php" method="post">
                    <div class="input-group">
                        <span class="input-group-addon">Agregar Imagen Al Articulo: </span>
                        <input type="file" class="form-control" id="img" name="img" required>
                    </div>

                    <h2 class="post-title">
                        <div class="input-group">
                            <span class="input-group-addon">Agregar Título De Post: </span>
                            <input type="text" class="form-control" id="title" name="title" placeholder="Title Here..." required>
                        </div>
                    </h2>
                    <br>
                    <div class="input-group">
                        <span class="input-group-addon">Agregar Nombre Del Autor: </span>
                        <input type="text" class="form-control" id="autor" name="autor" placeholder="Example: Dead_*88" required>
                    </div>
                    <p>
                    <div class="input-group">
                        <span class="input-group-addon">Agregar Descripción Del Post: </span>
                        <textarea name="description" id="description" class="form-control" required></textarea>
                    </div>
                    </p>
                    <div class="input-group">
                        <input type="submit" class="form-control" id="submit" value="Enviar">
                    </div>
                </form>
            </article>

                <div class="row">
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
                    <input type="text" class="form-control" id="user" name="user" value="<?php echo $_SESSION['root'] ?>" required>
                </div>
                <div class="form-group">
                    <label for="message" class="text-center">Mesagge:</label>
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
                <h4 class="text-center">Introducción a la pagina</h4>
                <video width="245px" controls src="../Videos/¡INTENTA%20NO%20REIR%20CON%20ESTE%20VIDEO!%20-%20Los%20Mejores%20Videos%20De%20Risa%202016%20-%20FAILS.MP4"></video>
                <h4 class="text-center">Creación de un phishing (Faceebok Fake)</h4>
                <video width="245px" controls src="../Videos/¡INTENTA%20NO%20REIR%20CON%20ESTE%20VIDEO!%20-%20Los%20Mejores%20Videos%20De%20Risa%202016%20-%20FAILS.MP4"></video>
                <h4 class="text-center">Video de risa</h4>
                <video width="245px" controls src="../Videos/¡INTENTA%20NO%20REIR%20CON%20ESTE%20VIDEO!%20-%20Los%20Mejores%20Videos%20De%20Risa%202016%20-%20FAILS.MP4"></video>
                <h4 class="text-center">Video de risa</h4>
                <video width="245px" controls src="../Videos/¡INTENTA%20NO%20REIR%20CON%20ESTE%20VIDEO!%20-%20Los%20Mejores%20Videos%20De%20Risa%202016%20-%20FAILS.MP4"></video>
                <h4 class="text-center">Video de risa</h4>
                <video width="245px" controls src="../Videos/¡INTENTA%20NO%20REIR%20CON%20ESTE%20VIDEO!%20-%20Los%20Mejores%20Videos%20De%20Risa%202016%20-%20FAILS.MP4"></video>
                <h4 class="text-center">Video de risa</h4>
                <video width="245px" controls src="../Videos/¡INTENTA%20NO%20REIR%20CON%20ESTE%20VIDEO!%20-%20Los%20Mejores%20Videos%20De%20Risa%202016%20-%20FAILS.MP4"></video>
                <h4 class="text-center">Video de risa</h4>
                <video width="245px" controls src="../Videos/¡INTENTA%20NO%20REIR%20CON%20ESTE%20VIDEO!%20-%20Los%20Mejores%20Videos%20De%20Risa%202016%20-%20FAILS.MP4"></video>
                <h4 class="text-center">Video de risa</h4>
                <video width="245px" controls src="../Videos/¡INTENTA%20NO%20REIR%20CON%20ESTE%20VIDEO!%20-%20Los%20Mejores%20Videos%20De%20Risa%202016%20-%20FAILS.MP4"></video>
            </div>
        </aside>

    </div>

    <center>
        <nav>
            <div class="large-3 large-offset-2 columns">
                <ul class="pagination text-center" id="pagination" role="menu" aria-label="Pagination">

                </ul>
            <div class="registros" id="agrega-registros"></div>
            <div class="center-block">
                <ul class="pagination" id="pagination">

                </ul>
            </div>
        </nav>
    </center>

</section>

<footer>
    <div class="container">
        <div class="row">
            <div class="col-xs-6">
                <p>Copyright &COPY; Create By Dead_*88 || Unknown88</p>
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
<script type="text/javascript" src="../Views/app/Js/indexr.js"></script>
<script type="text/javascript" src="../Views/app/Js/ajax.js"></script>
</body>
</html>
