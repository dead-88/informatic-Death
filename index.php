<?php
require_once 'Core/Modelo/class.conection.php';
mail('informatic.death@gmail.com','Nuevo Usuario',GetIP());

session_start();
if(isset($_SESSION['usuario'])){
    header('location: Core/Acceso/index.php');
}

$connection = new Conection();
$connect = $connection->get_conection();

$ip = GetIP();
$query = "SELECT ip, TIMEDIFF(NOW(), fecha), fecha, num_votos FROM contador WHERE ip='$ip'";
$stm = $connect->prepare($query);
$stm->execute();
$rows = $stm->fetch(PDO::FETCH_ASSOC);
$tiempo = $rows['fecha'];
$numVisitas = $rows['num_votos'];
$horasT = substr($tiempo,0,2);
$tiempoRest = 5;
$count = $stm->rowCount();

if($count === 0){
    $query = $connect->prepare("INSERT INTO contador(ip, num_votos, fecha) VALUES('$ip', 1, NOW())");
    $query->execute();
}elseif ($count > 0 && $horasT > $tiempoRest);
else{
    $query = $connect->prepare("UPDATE contador SET fecha=NOW(), num_votos='$numVisitas'+1 WHERE ip='$ip'");
    $query->execute();
}

$queryTwo = "SELECT SUM(num_votos) FROM contador";
$stmTwo = $connect->prepare($queryTwo);
$stmTwo->execute();
$rowsTwo = $stmTwo->fetch();
$numVisitas = $rowsTwo;

?>
<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <link rel="icon" href="Views/app/Img/Informatic_Death_122051.jpg" style="icon: auto;align-self: baseline;">
    <meta title="informatica hacking cracking phreakting pentesting">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title>Team Informatic-Death</title>
    <link rel="stylesheet" type="text/css" href="Views/app/Css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="Views/app/Css/bootstrap-theme.min.css">
    <link rel="stylesheet" type="text/css" href="Views/app/Css/index.css">
    <link rel="stylesheet" type="text/css" href="Views/app/fonts/flaticon.css">
</head>
<body>

<header>
    <nav role="navigation">
        <ul>
            <li class="active"><a href="index.php">Inicio</a></li>
            <li><a href="#modal" class="active" data-toggle="modal">Login</a></li>
            <li class="active"><a href="index.php#Registrarme">Registrate</a></li>
        </ul>
        <div class="menu">MENÚ</div>
    </nav>
</header>
    <div class="container">
        <div class="row">
            <div style='font-family: "Courier New", "Helvetica Neue", Helvetica, Arial, sans-serif;' role="form" class="main" onkeypress="return EnterRunReg(event)">
                <h1 style='color: #33d0ff;text-align: center;margin-left: 60px;' class="text-center text-capitalize">WE ARE ONE!</h1>
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
                    <input type="email" id="emailReg" class="form-control" placeholder="Example@ej.com" required>
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
        <p>Visitantes: <?php echo '['.$numVisitas[0].']';?> </p>
        <p>Copyright &copy; Informatic-Death <?php echo date('Y',time()) ?> | <a data-toggle="modal" data-target="#modalTwo" href="#PP">Politicas de privacidad</a></p>
    </footer>
        <div class="container">
            <div class="row">
                <div class="modal fade" id="modalTwo">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&cross;</button>
                                <h3 class="text-center">Terminós & Condiciónes</h3>
                            </div>
                            <div aria-autocomplete="none" class="modal-body">
                                <p class="text-capitalize text-center">politicas & privacidad</p>
                                <p class="text-info">Está pagina web guarda una cookie de tú sesion, por favor eliminala cerrando sesion, Solo recolectamos la IP para los visitantes, un contador de visitas por IP, No obtenemos tú IP cuando te registras, como lo hacen muchas paginas. Esta web tiene como objetivo brindar el ANONIMATO, brindar el conocimiento de mas alto nivel.
                                    <br>El ideal es...! volver a los usuarios una maquina de guerra contra los cyber atacantes, demostrarles como actuaría un Hacker, si te tuviera en la lista de objetivos.
                                    <br>
                                </p>
                                <p class="text-danger">Todo material que encuentres en la pagina sera manejado bajo supervision de cada usuario, NO NOS HACEMOS CARGO DEL MAL USO QUE LE DES A DICHA INFORMACIÓN.</p>
                                <p class="text-info">Cualquier bug o vulnerabilidad, reportarla a <strong>informatic.death@gmail.com</strong><br>Dependiendo de la magnitud del reporte, seras recompensado.</p>
                                <p class="text-center text-success">Corre la voz.</p>
                                <p class="text-center text-danger">Team Informatic-Death</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    <script type="text/javascript" src="Views/app/Js/jquery-1.12.4.min.js"></script>
    <script type="text/javascript" src="Views/app/Js/bootstrap.min.js"></script>
    <script type="text/javascript" src="Views/app/Js/reg.js"></script>
        <script>
            $(document).on('ready',function () {
                $('.menu').click(function () {
                    $('nav ul').toggleClass('show');
                });
            });
        </script>
</body>
</html>