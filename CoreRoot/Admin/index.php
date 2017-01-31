<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title>Hacking and more on Dead_*88</title>
    <link rel="stylesheet" type="text/css" href="../Views/app/Css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../Views/app/Css/bootstrap-theme.min.css">
    <link rel="stylesheet" type="text/css" href="../Views/app/Css/index.css">
</head>
<body>

<header>
    <nav class="navbar navbar-fixed-top navbar-inverse" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button class="collapsed navbar-toggle" data-toggle="collapse" data-target="#nav88" type="button">
                    <span class="sr-only"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>
            <div class="collapse navbar-collapse" id="nav88">
                <ul class="nav navbar-nav">
                    <li class="active nav-tabs"><a href="index.php">Panel De Administrador</a></li>
                </ul>
            </div>
        </div>
    </nav>
</header>
<div class="container">
    <div class="row">
        <form class="main" action="../Core/Controlador/checker_login_a.php" method="post">
            <h1 class="text-center text-primary text-capitalize">Inicio De Sesion</h1>
            <div class="input-group">
                <span class="input-group-addon">Usuario:</span>
                <input type="text" name="login" class="form-control" placeholder="Ingresa tú usuario" required>
            </div>
            <br>
            <div class="input-group">
                <span class="input-group-addon">Password:</span>
                <input type="password" name="passwd" class="form-control" placeholder="Ingresa tú contraseña" required>
            </div>
            <br>
            <input type="submit" class="btn form-control" value="Acceder">
        </form>
    </div>
</div>
<footer>
    <div class="container">
        <div class="row">
            <p>Acceso Denegado A Usuarios Avanzados</p>
            <p class="text-danger">Si Eres Un Pentester Oh Fanatico Al Hacking Te Reomendamos Que No Intentes Acceder, Sin Acceso Autoriazo A Este Panel De Control</p>
        </div>
    </div>
</footer>

<script type="text/javascript" src="../Views/app/Js/jquery-1.12.4.min.js"></script>
<script type="text/javascript" src="../Views/app/Js/bootstrap.min.js"></script>
</body>
</html>