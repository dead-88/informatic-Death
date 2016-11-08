<?php include_once (HTML_DIR.'includes/header.php');?>
<body>

<?php include_once (HTML_DIR.'includes/topnav.php');?>

    <div class="container">
        <div class="row">
            <div role="form" class="main" onkeypress="return EnterRunReg(event)">
                <h1 class="text-center text-danger text-capitalize"><?php echo APP_TITLE ?>
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
                            <form action="Core/Controlador/checkerloginController.php" method="post">
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
<?php include(HTML_DIR.'includes/footer.php') ?>
</body>
</html>