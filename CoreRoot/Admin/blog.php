<?php
    require_once '../../Core/Modelo/class.conection.php';
    require_once '../../Core/Modelo/class.consultations.php';

session_start();
$modelo = new Consultations();
$conection = new Conection();
$connect = $conection->get_conection();

if(!isset($_SESSION['root'])){
    header('location: index.php');
}else{
    $admin = $connect->prepare("SELECT id_admin,user_admin,email,ip,date FROM admin WHERE id_admin = :uiadm");
    $admin->execute(array(":uiadm"=>$_SESSION['root']));
    $adminView = $admin->fetch(PDO::FETCH_ASSOC);

    $conversations = $modelo->viewUsers();
    $rowspost = $modelo->viewPost();

    if(isset($conversations) AND isset($rowspost)){
        foreach($conversations as $conversation){}
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
    <title>informatic-Death Hacking</title>
    <link rel="stylesheet" type="text/css" href="../../Views/app/Css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../../Views/app/Css/bootstrap-theme.min.css">
    <link rel="stylesheet" type="text/css" href="../../Views/app/Css/blog.css">
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
                <a href="blog.php" class="nav-tabs navbar-brand">WE ARE ONE</a>
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
                            <li><a href="#">My account</a></li>
                            <li><a href="../../Core/Controlador/close.php" class="text-danger">Logout</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>

<section class="jumbotron">
    <div class="container">
        <h1 class="titulo text-capitalize"><?php echo $adminView['user_admin']; ?></h1><br><br>
        <p>Panel De Administración <span>Bienvenido/a</span></p>
    </div>
</section>

<section class="main container">
    <div class="form">
        <form action="" method="post" name="search_form" id="search_form">
            <input type="text" name="searchForm" id="searchForm" placeholder="Buscar...">
        </form>
        <div id="result"></div>
    </div>
</section>

<section class="main container">
    <div class="row">

        <section class="posts col-md-9">

            <article class="post clearfix">
                <br>
                <div class="row">
                    <div class="col-md-12">
                        <!--BARRA DE PROGRESO-->
                        <div class="progress">
                            <div class="bar"></div >
                            <div class="percent">0%</div>
                        </div>
                        <!--FIN BARRA DE PROGRESO-->
                        <div class="col-md-8">
                            <form role="form" id="formularioPhoto" method="post" action="../ControllersRoot/registerPost.php">
                                <div id="container">
                                    <ul class="photos thumb pull-right">
                                        <li>
                                            <center>Imagen Post</center>
                                            <input type="file" id="imgPost" name="file[]" required>
                                            <div id="photo-1" class="link"></div>
                                            <div id="cerrar-photo-1" class="cerrar-photo"></div>
                                        </li>
                                    </ul>
                                </div>
                                <br>
                                <div class="input-group">
                                    <span class="input-group-addon">Categoria: </span>
                                    <input type="text" class="form-control" name="categoria" id="categoria" placeholder="Categoria Here..." required>
                                </div>
                                <br>
                                <div class="input-group">
                                    <span class="input-group-addon">Tema: </span>
                                    <input type="text" class="form-control" name="tema" id="tema" placeholder="Title Here..." required>
                                </div>
                                <br>
                                <div class="input-group">
                                    <span class="input-group-addon">Nombre Del Autor: </span>
                                    <input type="text" class="form-control" name="autor" id="autor" placeholder="Example: Dead_*88" required>
                                </div>
                                <br>
                                <div class="input-group">
                                    <span class="input-group-addon">Articulo: </span>
                                    <textarea id="articulo" class="form-control" name="articulo" required></textarea>
                                </div>
                                <br>
                                <center>
                                    <div class="boton">
                                        <input type="hidden" id="subir" name="subir" value="Subir">
                                        <input type="submit" id="uploadbtn" class="uploadbtn btn btn-primary btn-sm" value="Enviar">
                                    </div>
                                </center>
                                <br>
                            </form>
                        </div>
                        <div class="col-md-4">
                            <div class="msj"></div>
                            <div id="resultado"></div>
                            <div id="responseError"></div>
                        </div>
                    </div>
                </div>
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
                    <input type="text" class="form-control" id="userConvers" name="userConvers" value="<?php echo $adminView['user_admin']; ?>" required>
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
                <video src="#"></video>
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
                <p>Copyright &COPY; Create By Informatic-Death °-° Dead_*88</p>
            </div>
            <div class="col-xs-6">
                <ul class="list-inline text-right">
                    <li><a href="blog.php">Inicio</a></li>
                </ul>
            </div>
        </div>
    </div>
</footer>
<script type="text/javascript" src="../../Views/app/Js/jquery-1.12.4.min.js"></script>
<script type="text/javascript" src="../../Views/app/Js/jquery-ui.min.js"></script>
<script type="text/javascript" src="../../Views/app/Js/bootstrap.min.js"></script>
<script type="text/javascript" src="../../Views/app/Js/jquery.form.js"></script>
<script type="text/javascript" src="../../Views/app/Js/regMessRoot.js"></script>
<script type="text/javascript" src="../../Views/app/Js/ajax.js"></script>
<script type="text/javascript" src="../../Views/app/Js/registerPost.js"></script>
<script src="../../Views/app/Js/searchRoot.js"></script>
</body>
</html>