<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title>Hacking and more on Dead_*88</title>
    <link rel="stylesheet" type="text/css" href="../../Views/app/Css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../../Views/app/Css/bootstrap-theme.min.css">
    <link rel="stylesheet" type="text/css" href="../../Views/app/Css/index.css">
</head>
<body>

<header>
    <nav role="navigation">
        <ul>
            <li><a href="index.php">Panel De Administración</a></li>
        </ul>
    </nav>
</header>
<div class="container">
    <div class="row">
        <form class="main" action="../ControllersRoot/checker_login_a.php" method="post">
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
            <p class="text-danger">Si Eres Un Pentester O Fanatico Al Hacking Te Reomendamos Que No Intentes Acceder, Sin Acceso Autoriazo A Este Panel De Control</p>
        </div>
    </div>
</footer>

<script type="text/javascript" src="../../Views/app/Js/jquery-1.12.4.min.js"></script>
<script type="text/javascript" src="../../Views/app/Js/bootstrap.min.js"></script>
</body>
</html>