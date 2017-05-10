<?php
    include '../Include/header.php';

    $sesion = $consult->session();

    if(isset($_GET['aggcateg'])){
        $categorie  = htmlentities(addslashes($_POST['categorie']));
        $aggcateg   = $connect->prepare("INSERT INTO categorias (nombre) VALUES (:nombre)");
        $aggcateg->bindParam(':nombre',$categorie);
        $aggcateg->execute();
        header('location: index.php');
    }
?>

<section class="main container">
    <div class="form">
        <form action="" method="post" name="search_form" id="search_form">
            <input type="text" name="searchForm" id="searchForm" placeholder="Buscar..." title="Buscador de posts">
        </form>
        <div id="result"></div>
    </div>
    <article class="post clearfix">
        <br>
        <div class="row">
            <div class="col-md-12">
                <!--BARRA DE PROGRESO-->
                <div class="progresss">
                    <div class="barr"></div >
                    <div class="percenta">0%</div>
                </div>
                <!--FIN BARRA DE PROGRESO-->
                <div class="col-md-10">
                    <form role="form" id="formularioPost" method="post" action="../Controlador/regPost.php">
                        <h1 class="text-center post-title">Publica un articulo!</h1>
                        <div id="container">
                            <ul class="photos thumb pull-right">
                                <li>
                                    <input type="file" id="imgPost" name="file[]" required>
                                    <div id="photo-1" class="link"></div>
                                    <div id="cerrar-photo-1" class="cerrar-photo"></div>
                                </li>
                            </ul>
                        </div>
                        <br>
                        <center>
                            <div class="btn-group">
                                <select aria-label="Categoria" class="btn btn-primary dropdown-toggle text-capitalize" data-toggle="dropdown" name="categoria" id="categoria" required>
                                <option value="1" style="background: #e5eacc;color:#1e1e1e" value="0" selected>-- Select Categoria --</option>
                                    <?php
                                        $consult    = new Consultations();
                                        $post       = $consult->viewCategorias();

                                        echo '<opgroup>';
                                            foreach ($post as $viewPost){
                                                echo '<option style="background: #e5eacc;color:#1e1e1e" value="'.$viewPost['id'].'">'.$viewPost['nombre'].'</option>';
                                            }
                                        echo '</opgroup>';
                                    ?>
                                </select>
                                <br>
                                <?php
                                    if($sesion[0]['rango'] >= 2){
                                ?>
                                        <center><a data-toggle="modal" data-target="#modal-aggcateg" class="btn btn-primary">Agg categoria</a></center>
                                <?
                                    }
                                ?>
                            </div>
                        </center>
                        <br>
                        <div class="input-group">
                            <span class="input-group-addon">Titulo: </span>
                            <input type="text" class="form-control" name="tema" id="tema" title="Ej: Hackeando los sistemas." placeholder="Ej: Hackeando los sistemas." required/>
                        </div>
                        <br>
                        <div class="hidden">
                            <input type="hidden" name="autor" id="autor" value="<?php if(isset($sesion[0]['users'])){echo $sesion[0]['users'];}?>"  required>
                            <input type="hidden" name="id_autor" id="id_autor" value="<?php if(isset($sesion[0]['id_users'])){echo $sesion[0]['id_users'];}?>"  required>
                        </div>
                        <br>
                        <div class="input-group">
                            <span class="input-group-addon">Articulo: </span>
                            <textarea id="articulo" class="form-control articulo" name="articulo" placeholder="Escribe tú post." required></textarea>
                        </div>
                        <br>
                        <center>
                            <div class="boton">
                                <input type="hidden" id="subirtwo" name="subirtwo" value="Subirtwo">
                                <button type="submit" id="uploadbtn" class="btn btn-sm btn-primary btn-sm">Enviar</button>
                            </div>
                        </center>
                        <br>
                    </form>
                    <!-- Modal agg Categoria -->
                    <div class="modal fade modal-ext" id="modal-aggcateg" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <!--Content-->
                            <div class="modal-content modal-md">
                                <!--Header-->
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    <h3 class="w-100 text-center"><i class="fa fa-book"></i>Agregar categoria</h3>
                                </div>
                                <!--Body-->
                                <div class="modal-body">
                                    <form method="post" action="?aggcateg">
                                        <div class="md-form">
                                            <i class="fa fa-bookmark prefix"></i>
                                            <input type="text" id="form2" name="categorie" class="form-control">
                                            <label for="form2">Categoria</label>
                                        </div>
                                        <div class="text-center">
                                            <center>  <button type="submit" class="btn btn-sm btn-primary btn-sm" name="entrar" >Agregar</button>
                                        </div>
                                    </form>
                                </div>
                                <!--Footer-->
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger btn-sm ml-auto" data-dismiss="modal">Cerrar</button>
                                </div>
                            </div>
                            <!--/.Content-->
                        </div>
                    </div>
                    <!-- Fin modal agg categorie-->
                </div>
                <div class="col-md-2">
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
        <div class="row">
            <section class="posts col-md-9">
                <?php viewPost();?>
            </section>
        </div>
    </div>        
</section>

<section class="main container">
    <div class="row">
        <aside class="col-md-3 hidden-xs hidden-sm users_online">
            <h4 class="text-center" style="color: #000;">Usuarios!</h4>
            <div style="width: 100%; height: 312px;overflow: scroll;" class="list-group">
                <?php
                    foreach($allUsersOnline as $usersOn){
                        for ($i = 1; $i <= $usersCount; $i++){
                    }
                ?>
                    <a href="#Users" data-target="#<?php if(isset($usersOn)){echo $usersOn['id_users'];} ?>" data-toggle="modal" class="list-group-item">
                        <?php
                            echo $usersOn['users'];
                            if(null == $usersOn['name_foto']){
                                echo '<img width="30px" class="pull-right img-circle" src="../../Views/app/Img/user.png" alt="ErrorConnect">';
                            }else{
                                echo '<img width="30px" class="pull-right img-circle" src="../../Views/app/Img/ImgUsers/thumb_'.$usersOn['name_foto'].'" alt="ErrorConnect">';
                            }
                        ?>
                    </a>
                        <!-- MODAL DE USUARIOS ONLINE-->
                        <div class="container">
                            <div class="row">
                                <div class="modal fade" id="<?php if(isset($usersOn)){echo $usersOn['id_users'];} ?>">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&cross;</button>
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
                                                            <h4>Enviale un mensaje. <a href="Usuarios.php?id_users=<?php echo $usersOn['id_users'];?>">Aquí</a></h4>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--FIN MODAL USUARIOS ONLINE-->
                 <? } ?>
            </div>
            <h4 class="text-center" style="color: #000;">Espéra los cursos gratís!...</h4>
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
            <br>
            <h4 class="text-center" style="color: #000;">Noticia Reciente</h4>
            <a href="#notice" class="list-group-item">
                <h4 style="font-size: 18px;" class="list-group-item-text text-md-left"><?php if(isset($rows['autor'])) {echo 'Autor:<br> '.$rows['autor'];}?></h4>
                <br>
                <h5 style="font-size: 18px;" class="list-group-item-text text-md-left"><?php if(isset($rows['autor'])) {echo 'Tema:<br> '.ucwords($rows['tema']);}?></h5>
            </a>
            <br>
            <h4 class="text-center" style="color: #000;">Videos</h4>
            <div class="list-group list-video">

            </div>
        </aside>
        <section class="posts col-md-9">
            <div class="row">
                <h1 class="well post-h1 post text-center text-danger">Conversations...!</h1>
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
                        <input type="hidden" id="idUser" name="idUser" value="<?php if(isset($sesion[0]['id_users'])){echo $sesion[0]['id_users'];};?>" required>
                        <input type="hidden" id="userConvers" name="userConvers" value="<?php if(isset($sesion[0]['users'])){echo $sesion[0]['users'];}?>" required>
                    </div>
                    <div class="form-group">
                        <label for="message" class="text-center" style="color: #fff;">Message:</label>
                        <textarea name="message" id="message" placeholder="Enter message..." class="form-control textarea" role="textbox" required></textarea>
                    </div>
                    <center>
                        <button type="submit" class="btn btn-sm btn-primary btn-sm" id="send">Enviar</button>
                    </center>
            <br><br>
                </form>
        </section>
    </div>
</section>
<?php require_once '../Include/footer.php'?>