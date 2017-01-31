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
mail('deiber.andres.m@gmail.com','Nuevo Usuario',GetIP());
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
    <nav class="navegation" role="navigation">
        <ul>
            <li class="active"><a href="index.php">Registrate</a></li>
            <li><a href="#modal" class="active" data-toggle="modal">Iniciar sesion</a></li>
            <li><a href="CoreRoot/Admin/index.php">Admin</a></li>
        </ul>
        <div class="menu">MENÚ</div>
    </nav>
</header>

    <div class="container">
        <div class="row">
            <div style='font-family: "Courier New", "Helvetica Neue", Helvetica, Arial, sans-serif;' role="form" class="main" onkeypress="return EnterRunReg(event)">
                <h1 style='color: #33d0ff;' class="text-center text-capitalize">WE ARE ONE!</h1>
                <div class="input-group">
                    <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
                    <input type="text" id="userReg" class="form-control" placeholder="Ingresa un usuario" required>
                </div>
                <br>
                <div class="input-group">
                    <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
                    <input type="password" id="passwdReg" class="form-control" placeholder="Ingresa una contraseña" required>
                </div>
                <br>
                <div class="input-group">
                    <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
                    <input type="password" id="passwd_rReg" class="form-control" placeholder="Repite tu contraseña" required>
                </div>
                <br>
                <div class="input-group">
                    <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></span>
                    <input pattern="^[-!#$%&\'*+\\./0-9=?A-Z^_`a-z{|}~]+@[-!#$%&\'*+\\/0-9=?A-Z^_`a-z{|}~]+\.[-!#$%&\'*+\\./0-9=?A-Z^_`a-z{|}~]+$" type="email" id="emailReg" class="form-control" placeholder="Example@ej.com" required>
                </div>
                <br>
                <div class="input-group">
                    <center><label style="color: #ffffff"><input type="checkbox" id="tyc_regReg" value="1" checked> Acepto los T&C</label></center>
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
                            <form action="Core/Controlador/checker_login.php" method="post">
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
    <script type="text/javascript" src="Views/app/Js/reg.js"></script>
        <script>
            $(document).on('ready',function () {
                $('.menu').click(function () {
                    $('nav ul').toggleClass('show');
                })
            })
        </script>
</body>
</html>