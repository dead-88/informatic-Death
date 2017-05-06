<?php
    include '../Include/header.php';
    echo '<link rel="stylesheet" type="text/css" href="../../Views/app/Css/perfil.css">';

    //Ver todos mis mensajes enviados.
    $usersIdMsj = $user[0]['users'];
    $idMessage  = $connect->prepare("SELECT COUNT(message) FROM conversation WHERE user_name = '$usersIdMsj'");
    $idMessage->execute();
    $idMsj = $idMessage->fetch(PDO::FETCH_ASSOC);

    if(isset($idMsj)){
        foreach ($idMsj as $idMsjs){}
    }

?>
    <section class="main container">
        <div class="row">
            <section class="col-md-8">
                <?php
                    $fechaOne       = new DateTime($user[0]['date_update']);
                    $fechaTwo       = new DateTime(date('Y/m/d h:i:s a'));
                    $fechaUpdate    = $fechaOne->diff($fechaTwo);

                    if($fechaUpdate->d >= 1 || $user[0]['date_update'] == null){

                ?>
                <form autocomplete="off" action="../Controlador/updateUsers.php" method="post" enctype="multipart/form-data" class="content" id="formularioPhotoPerfil">
                    <h3 class="text-center" style="color: #000;">Configuración del perfíl</h3>
                    <article class="post clearfix">

                        <p class="hidden">
                            <input name="idu" type="hidden" value="<?php if(isset($user[0]['id_users'])){echo $user[0]['id_users'];}?>">
                        </p>

                        <div class="blockPerf">
                            <div id="container">
                                <ul class="thumb">
                                    <li>
                                        <input type="file" id="archivo1" name="file[]">
                                        <div id="photo-1" class="link"></div>
                                        <div id="cerrar-photo-1" class="cerrar-photo cerrar-photo-p"></div>
                                    </li>
                                </ul>
                            </div>

                            <?php
                            echo '
                              <div class="text-date">
                                  <ol>
                                    <li>
                                    <label for="user">Usuario</label>
                                            <input type="text" value="'.$user[0]['users'].'" name="newUser" placeholder="Ingrese el nuevo usuario" required>
                                            <span>Enter you user to update here.</span>
                                    </li>
                                  </ol>
                              </div>';
                            ?>

                            <p class="post-content text-left"></p>

                            <?php
                            echo '<div class="form-style">
                                <ul>
                                    <li>
                                        <label for="pass">Password</label>
                                        <input type="password" placeholder="Ingresa la nueva clave" name="newPass" required>
                                        <span>Enter you password to update here.</span>
                                    </li>
                                </ul>
                                <ul>
                                    <li>
                                        <label for="passver">Checker You Password</label>
                                        <input type="password" placeholder="Ingresa la nueva clave" name="newPassTwo" required>
                                        <span>Verify your password to update here.</span>
                                    </li>
                                    <li style="color:#000;">"Tenga en cuenta que cada 24 horas podras actualizar tú información personal, Graciás."</li>
                                </ul>
                              </div>';
                            ?>
                            <br>
                            <center>
                                <div class="boton">
                                    <input type="hidden" id="subir" name="subir" value="Subir">
                                    <button type="submit" id="uploadbtn" class="btn btn-sm btn-primary btn-sm">Actualizar</button>
                                </div>
                                <br><br>
                                <div class="msj"></div>
                                <div id="resultado"></div>
                            </center>
                            <br>
                            <!--BARRA DE PROGRESO-->
                            <div class="progress">
                                <div class="bar"></div >
                                <div class="percent">0%</div>
                            </div>
                            <!--FIN BARRA DE PROGRESO-->
                        </div>
                    </article>
                </form>
                <?php }else{ ?>
                        <br>
                        <h3 class="text-center post-h1 post-title">No puedes actualizar más, espera 24 horas.</h3>
                        <?php
                            echo '<h3 class="text-center post-h1 post-title">Llevas '.$fechaUpdate->i.' Minutos & '.$fechaUpdate->h.' Horas.</h3>';
                        ?>
                <?php } ?>
            </section>
            <section class="col-md-4">
                <div class="vistaUsers">
                    <?php

                    $fecha1 = new DateTime($user[0]['date_registry']);
                    $fecha5 = new DateTime(date('Y/m/d h:i:s a'));
                    $fecha = $fecha1->diff($fecha5);

                    echo '<h1 class="text-center post-title">Perfíl</h1>';

//                    if($user[0]['online'] == 1){
//                        echo '<center><img src="../../Views/app/Img/connect.png"></center>';
//                    }else{
//                        echo '<center><img src="../../Views/app/Img/disconnect.png"></center>';
//                    }
                        echo '<br><center>';
                            if($user[0]['foto_user'] == null){
                                echo '<img src="../../Views/app/Img/803701665_122051.jpg" alt="Error" class="imgPhoto">';
                            }else{
                                echo '<img style="width: 100px;-webkit-border-radius: 5px;-moz-border-radius: 5px;border-radius: 5px;box-shadow: 1px 5px 10px #ffffff, 3px 15px 15px #000" src="data:image/*;base64,'.base64_encode($user[0]['foto_user']).'">';
                            }
                        echo '</center><br>';
                        echo '<p><strong>Usuario:</strong> '.$user[0]['users'].'</p>';
                        echo '<p><strong>E-Mail:</strong> '.$user[0]['email'].'<br><span class="text-info"> El email solo lo verás tú!</span></p>';

                        echo '<p>';

                        echo '<strong>Registrado El</strong><br>'.$user[0]['date_registry'].'<br>';

                        echo '<br><strong>Tiempo Transcurrido:</strong>';
                        if($fecha->y != 0){
                            echo '<br><strong>Años <br> </strong>['.$fecha->y.']';
                        } if($fecha->m != 0){
                            echo '<br><strong>Meses <br> </strong>['.$fecha->m.']';
                        } if($fecha->d != 0){
                            echo '<br><strong>Días <br> </strong>['.$fecha->d.']';
                        } if($fecha->h != 0){
                            echo '<br><strong>Horas <br> </strong>['.$fecha->h.']';
                        } if($fecha->i != 0){
                            echo '<br><strong>Minutos <br> </strong>['.$fecha->i.']';
                        }

                        echo '</p>';

                        echo '<p><strong>Messages Sent:</strong> '.$idMsjs[0].'</p>';
                        if($user[0]['rango'] == 0){
                            echo '<p><strong>Rango:</strong> <span style="color: #169c23;font-weight: bold; font-family: Courier,Arial,Verdana;"> {Usuario}</span></p>';
                        }else if($user[0]['rango'] == 1){
                            echo '<p><strong>Rango:</strong> <span style="color: #00b0ff;font-weight: bold; font-family: Courier,Arial,Verdana;"> [Moderador]</span></p>';
                        }else if($user[0]['rango'] == 2){
                            echo '<p><strong>Rango:</strong> <span style="color: #ff0000;font-weight: bold; font-family: Courier,Arial,Verdana;"> ..::Administrador::..</span></p>';
                        }
                    ?>
                </div>
            </section>
        </div>
    </section>
    <footer>
    <div class="color-footer col-xs-12">
        <p>Copyright &COPY; <?php echo date("Y"); ?> Created By Death_*88 & BL0CK_LT3 <strong>Team Informatic-Free</strong></p>
    </div>
</footer>
<script type="text/javascript" src="../../Views/app/Js/jquery.js"></script>
<script type="text/javascript" src="../../Views/app/Js/bootstrap.js"></script>
<script type="text/javascript" src="../../Views/app/Js/jquery.form.js"></script>
<script type="text/javascript" src="../../Views/app/Js/UploadImgPerfil.js"></script>
<script type="text/javascript" src="../../Views/app/Js/mdb.min.js"></script>