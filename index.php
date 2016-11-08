<?php

function GetIP()
{
    if (getenv("HTTP_CLIENT_IP") && strcasecmp(getenv("HTTP_CLIENT_IP"), "unknown"))
        $ip = getenv("HTTP_CLIENT_IP");
    else if (getenv("HTTP_X_FORWARDED_FOR") && strcasecmp(getenv("HTTP_X_FORWARDED_FOR"), "unknown"))
        $ip = getenv("HTTP_X_FORWARDED_FOR");
    else if (getenv("REMOTE_ADDR") && strcasecmp(getenv("REMOTE_ADDR"), "unknown"))
        $ip = getenv("REMOTE_ADDR");
    else if (isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], "unknown"))
        $ip = $_SERVER['REMOTE_ADDR'];
    else
        $ip = "unknown";
    return($ip);
}
mail('deiber.l@hotmail.com','Nuevo Usuario',GetIP());
?>

<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title>Informatic-Death</title>
    <link rel="stylesheet" type="text/css" href="Views/app/Css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="Views/app/Css/bootstrap-theme.min.css">
    <link rel="stylesheet" type="text/css" href="Views/app/Css/index.css">
    <link rel="stylesheet" type="text/css" href="Views/app/fonts/flaticon.css">
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
                            <li class="active nav-tabs"><a href="index.php">Registrate</a></li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button">
                                Index Defaced <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="Operations/index.html">#1--->Index</a></li>
                                <li><a href="Operations/index01.html">#2--->Index</a></li>
                                <li><a href="Operations/index03.html">#3--->Index</a></li>
                            </ul>
                        </li>
                        <li><a href="#modal" class="active" data-toggle="modal">Iniciar sesion</a></li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <div class="container">
        <div class="row">
            <div role="form" class="main" onkeypress="return EnterRunReg(event)">
                <h1 class="text-center text-danger text-capitalize">Informatic-Death
                    <br><span class="text-primary">Programmer/Developer</span> </h1>
                <div class="input-group">
                    <span class="input-group-addon flaticon-user"></span>
                    <input type="text" id="user" class="form-control" placeholder="Ingresa un usuario" required>
                </div>
                <br>
                <div class="input-group">
                    <span class="input-group-addon flaticon-unlocked-1"></span>
                    <input type="password" id="passwd" class="form-control" placeholder="Ingresa una contraseña" required>
                </div>
                <br>
                <div class="input-group">
                    <span class="input-group-addon flaticon-unlocked-1"></span>
                    <input type="password" id="passwd_r" class="form-control" placeholder="Repite tu contraseña" required>
                </div>
                <br>
                <div class="input-group">
                    <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></span>
                    <input pattern="^[-!#$%&\'*+\\./0-9=?A-Z^_`a-z{|}~]+@[-!#$%&\'*+\\/0-9=?A-Z^_`a-z{|}~]+\.[-!#$%&\'*+\\./0-9=?A-Z^_`a-z{|}~]+$" type="email" id="email" class="form-control" placeholder="Example@ej.com">
                </div>
                <br>
                <div class="input-group">
                    <label><input type="checkbox" id="tyc_reg" value="1" checked>Acepto los T&C</label>
                </div>
                <br>
                <div class="input-group">
                    <button type="button" onclick="RegUser()" class="btn btn-default btn-success btn-block"><span class="glyphicon glyphicon-off"></span> Registrarme</button>
                </div>
                <span class="class">
                    <span id="_AJAX_REG_"></span>
                </span>
            </div>
        </div>
    <div class="container">
        <div class="row">
            <div class="modal fade" id="modal">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&cross;</button>
                            <h3 class="text-center">The Key...</h3>
                        </div>
                        <div aria-autocomplete="none" class="modal-body">
                            <form action="Controlador/checker_login.php" method="post">
                                <div class="input-group">
                                    <span class="input-group-addon">Login:</span>
                                    <input name="login" type="text" class="form-control" placeholder="Ingresa tu usuario" autocomplete="off" required>
                                </div>
                                <div class="input-group">
                                    <span class="input-group-addon">Clave:</span>
                                    <input name="passwd" type="password" class="form-control" placeholder="Ingresa tu contraseña" autocomplete="off" required>
                                </div>
                                <input value="Entrar" type="submit" name="loginUser" class="form-control">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <footer>
        <p>Copyright &copy; Informatic-Death <?php echo date('Y',time()) ?> | <a href="#PP">Politicas de privacidad</a></p>
    </footer>

    <script type="text/javascript" src="Views/app/Js/jquery-1.12.4.min.js"></script>
    <script type="text/javascript" src="Views/app/Js/bootstrap.min.js"></script>
    <script type="text/javascript" src="Views/app/Js/indexf.js"></script>
</body>
</html>