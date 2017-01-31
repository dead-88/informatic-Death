<?php require_once '../Include/header.php';?>
<br><br>
    <section class="main container">
        <div class="row">
            <section class="posts col-md-9">
                <form action="../Controlador/updateUsers.php" method="post" enctype="multipart/form-data" class="content" id="formularioPhotoPerfil">
                    <h3 class="text-center">Configuración del perfiíl</h3>
                    <article class="post clearfix">

                        <p class="hidden">
                            <input name="idu" type="hidden" value="<?php if(isset($user['id_users'])){echo $user['id_users'];}?>">
                        </p>

                        <div class="blockPerf">
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
                              <br>
                                <span class="post-fecha">'.$user['date_registry'].'</span> 
                                <span class="post-autor"> ..:::Date of Registry::..</span>
                              </div>';
                            ?>
                            <div id="container">
                                <center>
                                    <ul class="thumb">
                                        <li>
                                            <h5 class="text-act">Foto</h5>
                                            <input type="file" id="archivo1" name="file[]" required>
                                            <div id="photo-1" class="link"></div>
                                            <div id="cerrar-photo-1" class="cerrar-photo"></div>
                                        </li>
                                    </ul>
                                </center>
                            </div>
                            <p class="post-content text-left">Lorem ipsum dolor sit amet, consectetur adipisicing elit. At consectetur est eveniet excepturi nihil odit officiis, qui recusandae tempore. Labore laborum maxime neque possimus provident quas, ratione sed totam vero? Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet asperiores, doloremque ea hic iure laborum maxime officia omnis possimus saepe sapiente sunt, temporibus, voluptas. Assumenda laudantium maiores maxime quam voluptate? Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aspernatur at beatae consequuntur cumque deserunt enim esse est et explicabo iste laboriosam libero maiores molestiae nam natus repellat suscipit temporibus, vel!</p>
                            <?php
                            echo '<div class="form-style">
                                <ul>
                                    <li>
                                        <label for="email">E-Mail</label>
                                        <input type="text" value="'.$user['email'].'" name="newMail" required>
                                        <span>Enter you email to update here.</span>
                                    </li>
                                    <li>
                                        <label for="pass">Password</label>
                                        <input type="password" placeholder="Ingresa la nueva clave" name="newPass" required>
                                        <span>Enter you password to update here.</span>
                                    </li>
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
            </section>
            <section class="col-md-3">
                <div class="vistaUsers">
                    <?php

                    $fecha1 = new DateTime($user['date_registry']);
                    $fecha5 = new DateTime(date('Y/m/d h:i:s a'));
                    $fecha = $fecha1->diff($fecha5);

                    echo '<h1 class="text-center text-success">Perfíl</h1>';
                        echo '<br><center>';
                            if($user['foto_user'] == null){
                            echo '<img src="../../Views/app/Img/803701665_122051.jpg" alt="Error" class="imgPhoto">';
                        }else{
                            echo '<img style="width: 100px;-webkit-border-radius: 5px;-moz-border-radius: 5px;border-radius: 5px;box-shadow: 1px 5px 10px #ffffff, 3px 15px 15px #000" src="data:image/*;base64,'.base64_encode($user['foto_user']).'">';
                        }
                        echo '</center><br>';
                        echo '<p><strong>Usuario:</strong> '.$user['users'].'</p>';
                        echo '<p><strong>E-Mail:</strong> '.$user['email'].'</p>';
                        echo '<p><strong>Registrado El</strong><br>'.$user['date_registry'].'<br>'.'<strong>Meses-> </strong>'.$fecha->m,'<br><strong>Días-> </strong>'.$fecha->d,'<br><strong>Horas-> </strong>'.$fecha->h.'</p>';
                        echo '<p><strong>Mensajes:</strong> '.$idMsjs[0].'</p>';
                    ?>
                </div>
            </section>
        </div>
    </section>
<?php require_once '../Include/footer.php'?>