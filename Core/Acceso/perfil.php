<?php
    require_once '../Include/header.php';

    //Ver todos mis mensajes enviados.
    $usersIdMsj = $user['users'];
    $idMessage  = $connect->prepare("SELECT COUNT(message) FROM conversation WHERE user_name = '$usersIdMsj'");
    $idMessage->execute();
    $idMsj = $idMessage->fetch(PDO::FETCH_ASSOC);


    if(isset($idMsj)){
        foreach ($idMsj as $idMsjs){}
    }

?>
<br><br>
    <section class="main container">
        <div class="row">
            <section class="col-md-8">
                <?php
                    $fechaOne       = new DateTime($user['date_update']);
                    $fechaTwo       = new DateTime(date('Y/m/d h:i:s a'));
                    $fechaUpdate    = $fechaOne->diff($fechaTwo);

                    if($fechaUpdate->d >= 1 || $user['date_update'] == null){

                ?>
                <form autocomplete="off" action="../Controlador/updateUsers.php" method="post" enctype="multipart/form-data" class="content" id="formularioPhotoPerfil">
                    <h3 class="text-center">Configuración del perfíl</h3>
                    <article class="post clearfix">

                        <p class="hidden">
                            <input name="idu" type="hidden" value="<?php if(isset($user['id_users'])){echo $user['id_users'];}?>">
                        </p>

                        <div class="blockPerf">
                            <div id="container">
                                <ul class="thumb">
                                    <li>
                                        <input type="file" id="archivo1" name="file[]">
                                        <div id="photo-1" class="link">Foto Perfíl</div>
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
                                            <input type="text" value="'.$user['users'].'" name="newUser" required>
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
                                        <span>Verify you password to update here.</span>
                                    </li>
                                    <li>"Tenga en cuenta que cada 24 horas podras actualizar tú información personal, Graciás."</li>
                                </ul>
                              </div>';
                            ?>
                            <br>
                            <center>
                                <div class="boton">
                                    <input type="hidden" id="subir" name="subir" value="Subir">
                                    <input type="submit" id="uploadbtn" class="uploadbtn btn btn-primary btn-sm" value="Actualizar">
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
                        <h3 class="text-center post-h1 post-title">No puedes actualizar más, espera 24 horas.</h3>
                        <?php
                            echo '<h3 class="text-center post-h1 post-title">Llevas '.$fechaUpdate->i.' Minutos & '.$fechaUpdate->h.' Horas.</h3>';
                        ?>
                <?php } ?>
            </section>
            <section class="col-md-4">
                <div class="vistaUsers">
                    <?php

                    $fecha1 = new DateTime($user['date_registry']);
                    $fecha5 = new DateTime(date('Y/m/d h:i:s a'));
                    $fecha = $fecha1->diff($fecha5);

                    echo '<h1 class="text-center text-success">Perfíl</h1>';

                    if($user['online'] == 1){
                        echo '<center><img src="../../Views/app/Img/connect.png"></center>';
                    }else{
                        echo '<center><img src="../../Views/app/Img/disconnect.png"></center>';
                    }
                        echo '<br><center>';
                            if($user['foto_user'] == null){
                                echo '<img src="../../Views/app/Img/803701665_122051.jpg" alt="Error" class="imgPhoto">';
                            }else{
                                echo '<img style="width: 100px;-webkit-border-radius: 5px;-moz-border-radius: 5px;border-radius: 5px;box-shadow: 1px 5px 10px #ffffff, 3px 15px 15px #000" src="data:image/*;base64,'.base64_encode($user['foto_user']).'">';
                            }
                        echo '</center><br>';
                        echo '<p><strong>Usuario:</strong> '.$user['users'].'</p>';
                        echo '<p><strong>E-Mail:</strong> '.$user['email'].'</p>';

                        echo '<p>';

                        echo '<strong>Registrado El</strong><br>'.$user['date_registry'].'<br>';

                        echo '<br><strong>Tiempo Transcurrido:</strong>';
                        if($fecha->y != 0){
                            echo '<br><strong>Años <br> </strong>['.$fecha->y.']';
                        }else if($fecha->m != 0){
                            echo '<br><strong>Meses <br> </strong>['.$fecha->m.']';
                        }else if($fecha->d != 0){
                            echo '<br><strong>Días <br> </strong>['.$fecha->d.']';
                        }else if($fecha->h != 0){
                            echo '<br><strong>Horas <br> </strong>['.$fecha->h.']';
                        }else if($fecha->i != 0){
                            echo '<br><strong>Minutos <br> </strong>['.$fecha->i.']';
                        }

                        echo '</p>';

                        echo '<p><strong>Messages Sent:</strong> '.$idMsjs[0].'</p>';
                        if($user['rango'] == 0){
                            echo '<p><strong>Rango:</strong> <span style="color: #169c23;font-weight: bold; font-family: Courier,Arial,Verdana;"> {Usuario}</span></p>';
                        }else if($user['rango'] == 1){
                            echo '<p><strong>Rango:</strong> <span style="color: #00b0ff;font-weight: bold; font-family: Courier,Arial,Verdana;"> [Moderador]</span></p>';
                        }else if($user['rango'] == 2){
                            echo '<p><strong>Rango:</strong> <span style="color: #ff0000;font-weight: bold; font-family: Courier,Arial,Verdana;"> ..::Administrador::..</span></p>';
                        }
                    ?>
                </div>
            </section>
        </div>
    </section>
<?php require_once '../Include/footer.php'?>