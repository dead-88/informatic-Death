<?php include '../Include/header.php';?>
<section class="jumbotron">
    <div class="container">
        <h2 class="titulo text-capitalize">
            <?php
                if(isset($user['foto_user']) == null || isset($user['foto_user']) == ''){
                    echo '<img src="data:image/*;base64,'.base64_encode($user['foto_user']).'" alt="Error" class="thumb pull-left">';
                }else{
                    echo '<img src="../../Views/app/Img/Informatic_Death_122051.jpg" alt="Error" class="thumb pull-left">';
                }
                if(isset($user['users'])){echo $user['users'];}
            ?>
        </h2>
        <p class="text-left">Acercate más! <span>Te mostrare algo.</span></p>
    </div>
    <div class="clearfix"></div>
</section>

<section class="main container">
    <div class="form">
        <form action="" method="post" name="search_form" id="search_form">
            <input type="text" name="searchForm" id="searchForm" placeholder="Buscar...">
        </form>
        <div id="result"></div>
    </div>
    <article class="post clearfix">
        <br>
        <div class="row">
            <div class="col-md-12">
                <!--BARRA DE PROGRESO-->
                <div class="progress">
                    <div class="bar"></div >
                    <div class="percent">0%</div>
                </div>
                <!--FIN BARRA DE PROGRESO-->
                <div class="col-md-8">
                    <form role="form" id="formularioPhoto" method="post" action="../ControllersRoot/registerPost.php">
                        <div id="container">
                            <ul class="photos thumb pull-right">
                                <li>
                                    <center>Imagen Post
                                        <input type="file" id="imgPost" name="file[]" required>
                                        <div id="photo-1" class="link"></div>
                                        <div id="cerrar-photo-1" class="cerrar-photo"></div>
                                    </center>
                                </li>
                            </ul>
                        </div>
                        <br>
                        <div class="input-group">
                            <span class="input-group-addon">Categoria: </span>
                            <input type="text" class="form-control" name="categoria" id="categoria" placeholder="Categoria Here..." required>
                        </div>
                        <br>
                        <div class="input-group">
                            <span class="input-group-addon">Tema: </span>
                            <input type="text" class="form-control" name="tema" id="tema" placeholder="Title Here..." required>
                        </div>
                        <br>
                        <div class="input-group">
                            <span class="input-group-addon">Autor: </span>
                            <input type="text" class="form-control" name="autor" id="autor" placeholder="Example: informatic-Death" required>
                        </div>
                        <br>
                        <div class="input-group">
                            <span class="input-group-addon">Articulo: </span>
                            <label for="textarea">
                                <textarea id="articulo" class="form-control" name="articulo" required></textarea>
                            </label>
                        </div>
                        <br>
                        <center>
                            <div class="boton">
                                <input type="hidden" id="subir" name="subir" value="Subir">
                                <input type="submit" id="uploadbtn" class="uploadbtn btn btn-primary btn-sm" value="Enviar">
                            </div>
                        </center>
                        <br>
                    </form>
                </div>
                <div class="col-md-4">
                    <div class="msj"></div>
                    <div id="resultado"></div>
                    <div id="responseError"></div>
                </div>
            </div>
        </div>
    </article>
    <h1 style="cursor: pointer;text-align: center;" href="#view" class="post-fecha post-h1 viewEight">Ver Articulos
        [<?php
        if(isset($idPost)){
            echo $idPost;
        }
        ?>]
    </h1>
    <div class="objEight">
        <?php viewPost();?>
    </div>
</section>

<section class="main container">
    <div class="row">
        <aside class="col-md-3 hidden-xs hidden-sm users_online">
            <h4 class="text-center">Usuarios Online!</h4>
            <div class="list-group">
                <?php
                    foreach($allUsersOnline as $usersOn){
                        for ($i = 1; $i <= $usersCount; $i++){
                    }
                ?>
                    <a href="#Users" data-target="#<?php if(isset($usersOn)){echo $usersOn['id_users'];} ?>" data-toggle="modal" class="list-group-item">
                        <?php
                            echo $usersOn['users'];
                        ?>
                        <img class="pull-right" src="../../Views/app/Img/connect.png" alt="ErrorConnect">
                    </a>
<!--                        MODAL DE USUARIOS ONLINE-->
                        <div class="container">
                            <div class="row">
                                <div class="modal fade" id="<?php if(isset($usersOn)){echo $usersOn['id_users'];} ?>">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&cross;</button>
<!--                                                <h3 class="text-center">DETALLES DEL USUARIO --><?php //echo strtoupper($usersOn['users']);?><!--</h3>-->
                                            </div>
                                            <div aria-autocomplete="none" class="modal-body">
                                                <div>
                                                    <div class="card">
                                                        <div class="card-up">
                                                            <center><h2>PERFÍL DE <?php echo strtoupper($usersOn['users']);?></h2></center>
                                                        </div>
                                                        <div class="avatar">
                                                            <?php
                                                                if(null == $usersOn['foto_user']){
                                                                    echo '<img class="img-circle" src="../../Views/app/Img/Informatic_Death_122051.jpg" alt="Error">';
                                                                }else{
                                                                    echo '<img class="img-circle" src="data:image/*;base64,'.base64_encode($usersOn['foto_user']).'" alt="Error">';
                                                                }
                                                            ?>
                                                        </div>
                                                        <div class="card-block">
                                                            <p>Se registro en el</p>
                                                            <p class="post-fecha"><?php echo $usersOn['date_registry']?></p>
                                                            <hr>
                                                            <h4>Enviale un mensaje.</h4>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
<!--                        FIN MODAL USUARIOS ONLINE-->
                 <? } ?>
            </div>
            <h4 class="text-center">Espéra los cursos gratís!...</h4>
            <div class="list-group">
                <a href="#view" class="list-group-item viewOne">Diseño Web</a>
                <div class="objOne">
                    Quieres aprender Diseño Web en pocos pasos? <br>Solo tienes que darle <a class="btn btn-danger" href="https://www.facebook.com/Informatic-Death-408473432825159/?fref=ts" target="_blank">ME GUSTA</a> y subscribirse en
                    nuestro canál de <a class="btn btn-danger" href="https://www.youtube.com/channel/UCnAMkI1bY_F3JeffekvPb8Q" target="_blank">YouTube.</a>
                    <p class="text-justify">Te enseñare a crear una Pagina Web desde cero.</p>
                </div>
                <a href="#view" class="list-group-item viewTwo">Php</a>
                <div class="objTwo">
                    Quieres aprender Php en pocos pasos? <br>Solo tienes que darle <a class="btn btn-danger" href="https://www.facebook.com/Informatic-Death-408473432825159/?fref=ts" target="_blank">ME GUSTA</a> y subscribirse en
                    nuestro canál de <a class="btn btn-danger" href="https://www.youtube.com/channel/UCnAMkI1bY_F3JeffekvPb8Q" target="_blank">YouTube.</a>
                    <p class="text-justify">Te enseñare a crear un CRUD orientado a objetos desde cero con  MYSQL, PHP (CRUD with PDO)</p>
                </div>
                <a href="#view" class="list-group-item viewTree">JavaScript</a>
                <div class="objTree">
                    Quieres aprender JavaScript en pocos pasos? <br>Solo tienes que darle <a class="btn btn-danger" href="https://www.facebook.com/Informatic-Death-408473432825159/?fref=ts" target="_blank">ME GUSTA</a> y subscribirse en
                    nuestro canál de <a class="btn btn-danger" href="https://www.youtube.com/channel/UCnAMkI1bY_F3JeffekvPb8Q" target="_blank">YouTube.</a>
                    <p class="text-justify">Te enseñare a crear un LogIn con varias capas de seguridad.</p>
                </div>
                <a href="#view" class="list-group-item viewFort">Css3</a>
                <div class="objFort">
                    Quieres aprender Css3 en pocos pasos? <br>Solo tienes que darle <a class="btn btn-danger" href="https://www.facebook.com/Informatic-Death-408473432825159/?fref=ts" target="_blank">ME GUSTA</a> y subscribirse en
                    nuestro canál de <a class="btn btn-danger" href="https://www.youtube.com/channel/UCnAMkI1bY_F3JeffekvPb8Q" target="_blank">YouTube.</a>
                    <p class="text-justify">Te enseñare a Maquillar una Pagina Web, Para que se vea Elegante.</p>
                </div>
                <a href="#view" class="list-group-item viewFix">Html5</a>
                <div class="objFix">
                    Quieres aprender HTML5 en pocos pasos? <br>Solo tienes que darle <a class="btn btn-danger" href="https://www.facebook.com/Informatic-Death-408473432825159/?fref=ts" target="_blank">ME GUSTA</a> y subscribirse en
                    nuestro canál de <a class="btn btn-danger" href="https://www.youtube.com/channel/UCnAMkI1bY_F3JeffekvPb8Q" target="_blank">YouTube.</a>
                    <p class="text-justify">Te enseñare a crear Paginas Completas. Desde cero</p>
                </div>
                <a href="#view" class="list-group-item viewSix">JQuery</a>
                <div class="objSix">
                    Quieres aprender JQuery en pocos pasos? <br>Solo tienes que darle <a class="btn btn-danger" href="https://www.facebook.com/Informatic-Death-408473432825159/?fref=ts" target="_blank">ME GUSTA</a> y subscribirse en
                    nuestro canál de <a class="btn btn-danger" href="https://www.youtube.com/channel/UCnAMkI1bY_F3JeffekvPb8Q" target="_blank">YouTube.</a>
                    <p class="text-justify">Te enseñare a manejar Este Framework, Para que hagas tus paginas más Animadas. Desde cero.</p>
                </div>
                <a href="#view" class="list-group-item viewSeven">MySql + SQL</a>
                <div class="objSeven">
                    Quieres aprender MySQL & SQL en pocos pasos? <br>Solo tienes que darle <a class="btn btn-danger" href="https://www.facebook.com/Informatic-Death-408473432825159/?fref=ts" target="_blank">ME GUSTA</a> y subscribirse en
                    nuestro canál de <a class="btn btn-danger" href="https://www.youtube.com/channel/UCnAMkI1bY_F3JeffekvPb8Q" target="_blank">YouTube.</a>
                    <p class="text-justify">Te enseñare a crear Bases de Datos & a manejar el lenguaje de consultas SQL. Desde cero.</p>
                </div>
            </div>
            <h4 class="text-center">Noticia Reciente</h4>
            <a href="#notice" class="list-group-item">
                <h4 class="list-group-item-heading"><?php echo 'Autor: '.isset($rows['autor'])?></h4>
                <p class="list-group-item-text"><?php echo 'Tema: '.isset($rows['tema'])?></p>
            </a>
            <h4 class="text-center">Videos</h4>
            <div class="list-group list-video">

            </div>
        </aside>
        <section class="posts col-md-9">
            <div class="row">
                <h1 class="well post-h1 post text-center text-danger">Conversations...!</h1>
                <p class="flaticon-document"> Comentariós:
                    [<?php
                        if(isset($maxMesj)){
                            echo $maxMesj;
                        }
                    ?>]</p>
                <form id="formChat" role="form" method="post">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12">
                                <div id="conversation"></div>
                            </div>
                        </div>
                    </div>
            </div>
                    <div class="hidden">
                        <input type="hidden" id="idUser" name="idUser" value="<?php if(isset($user['id_users'])){echo $user['id_users'];};?>" required>
                        <input type="hidden" id="userConvers" name="userConvers" value="<?php if(isset($user['users'])){echo $user['users'];}?>" required>
                    </div>
                    <div class="form-group">
                        <label for="message" class="text-center">Message:</label>
                        <textarea name="message" id="message" placeholder="Enter message..." class="form-control textarea" role="textbox" required></textarea>
                    </div>
                    <center><input type="submit" class="btn btn-primary" id="send" value="Enviar"></center>
            <br><br>
                </form>
        </section>
    </div>
</section>

<?php require_once '../Include/footer.php'?>