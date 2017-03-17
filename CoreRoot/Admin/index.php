<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title>Admin Informatic-Death</title>
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
        <form class="main" action="../ControllersRoot/checker_login_a.php" method="post" autocomplete="off">
            <h1 class="text-center text-primary">WELCOME ADMIN</h1>
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
            <p class="text-danger">Si eres un pentester o fanatico al hacking, cracking te reomendamos que NO intentes acceder sin acceso autoriazo a este panel de administración, Este acceso es monitorizado & no nos interesa si usas PROXYS, VPN, TOR, WHOANIX seras bloqueado por el Firewall, NO intentes hacer fuerza bruta, o DDoS. gracías por su atención.</p>
        </div>
    </div>
</footer>

<script type="text/javascript" src="../../Views/app/Js/jquery-1.12.4.min.js"></script>
<script type="text/javascript" src="../../Views/app/Js/bootstrap.min.js"></script>
</body>
</html>