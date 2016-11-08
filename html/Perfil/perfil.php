<?php
require_once '../Modelo/class.conection.php';
require_once '../Modelo/class.consultations.php';
require_once '../Controlador/loadarticlesController.php';

session_start();
if(!isset($_SESSION['usuario'])){
    header('location:../index.php');
}else {
    $modelo = new Consultations();
    $perf = $modelo->viewUsers();
    if($perf){
        foreach ($perf as $perfil){}
    }


//    if(isset($_GET['id']) and array_key_exists($_GET['id'],$_users)) {
//        $id_usuario = intval($_GET['id']);
//        $db = new Conexion();
//        $sql = $db->query("SELECT COUNT(id) FROM temas WHERE id_dueno='$id_usuario';");
//        include(HTML_DIR . 'perfil/perfil.php');
//        $db->liberar($sql);
//        $db->close();
//    } else {
//        header('location: ?view=index');
//    }
}

?>
<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title>Hacking Cracking & More...</title>
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
                <a href="#Welcome" class="nav-tabs navbar-brand">We Are One</a>
            </div>

            <!-- Inicio del menu -->
            <div class="collapse navbar-collapse" id="navegacion-fm">
                <ul class="nav navbar-nav">
                    <li class="active"><a href="../../Acceso/index.php">Inicio</a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button">
                            Herramientas <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="#">Windows x86 & x64</a></li>
                            <li><a href="#">Mac</a></li>
                            <li><a href="#">Linux x86 & x64</a></li>
                        </ul>
                    <li class="dropdown">
                        <a href="#" class="btn-nw dropdown-toggle pull-right" data-toggle="dropdown" role="button">
                            Configuración <span class="glyphicon glyphicon-console"></span>
                        </a>
                        <ul class="dropdown-menu pull-right" role="menu">
                            <li><a href="../Core/Controlador/close.php" class="text-danger">Cerrar sesion</a></li>
                            <li><a href="#">My account</a></li>
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


<section class="main container">

</section>


<section class="main container">
    <div class="row">
        <div class="post">
            <h2 class="text-center">My Perfil</h2>

            <article>
                <form action="../Core/Controlador/updateUsers.php" method="post">
                    <div class="input-group">
                        <span class="input-group-addon">Usuario: </span>
                        <input type="text" class="form-control" value="<?php echo $perfil['users'];?>" id="img" name="img" placeholder="Tú usuario" required>
                    </div>

                    <h2 class="post-title">
                        <div class="input-group">
                            <span class="input-group-addon">Password: </span>
                            <input type="text" class="form-control" value="<?php echo $perfil['password'];?>" id="title" name="title" placeholder="Title Here..." required>
                        </div>
                    </h2>
                    <div class="input-group">
                        <span class="input-group-addon">Email: </span>
                        <input type="text" class="form-control" value="<?php echo $perfil['email'];?>" id="autor" name="autor" placeholder="Example: Dead_*88" required>
                    </div>
                    <div class="input-group">
                        <input type="submit" class="form-control" id="submit" value="Enviar">
                    </div>
                </form>
            </article>

            <input type="submit" class="btn btn-primary" id="send">
            </form>
        </div>
    </div>

</section>

<footer>
    <div class="container">
        <div class="row">
            <div class="color-footer col-xs-6">
                <p>Copyright &COPY; <?php echo date("Y"); ?> Create By Dead_*88 & ClearDeath</p>
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