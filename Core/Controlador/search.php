<?php

require_once '../Modelo/class.conection.php';
require_once '../Modelo/class.consultations.php';

sleep(1);

session_start();
$conection  = new Conection();
$consult    = new Consultations();
$connect    = $conection->get_conection();
$viewCateg  = $consult->viewCategorias();
$session    = $consult->session();

$search = '';
if(isset($_POST['searchForm'])){
    $search = htmlentities(addslashes($_POST['searchForm']));
}

$tema   = "%".$search."%";
$query  = "SELECT * FROM post,categorias WHERE (post.tema LIKE :tema OR categorias.nombre LIKE :nombre) AND post.id_categoria = categorias.id ORDER BY post.id_blog DESC";
$stm    = $connect->prepare($query);
$stm->bindParam(':tema'     ,$tema);
$stm->bindParam(':nombre'   ,$tema);
$stm->execute();

$count  = $stm->rowCount();
$row    = $stm->fetch(PDO::FETCH_ASSOC);
    
if($count > 0 && $search != ''){
    echo '<h2 class="post-title"><center>Resultado de la búsqueda.</center></h2>';

    foreach ($viewCateg as $rowCateg){
        if($search == $rowCateg['nombre'] || $search == $row['tema']){

            echo '
                <div class="row">
                    <section class="posts col-md-9"> 
                        <article class="post clearfix">
                            <h1 style="padding-left: 10px; border-left: #ff0000 3px solid;background-color: #0f0f0f;" class="post-fecha text-center text-capitalize">
                                '.$rowCateg['nombre'].'
                            </h1>';

                                do{
                                    $article    = nl2br($row['article']);
                                    $targetHttp = $consult->link($article);
                                    $newarticle = wordwrap($targetHttp, 32, "\n", true);
                                    $newtema    = wordwrap($row['tema'], 15, "\n", true);

                                    if($session[0]['rango'] >= 2){ ?>
                                        <center>
                                            <span style="cursor: pointer;" class="btn btn-sm btn-danger btn-sm" onclick="Confirm(<?php echo $row['id_blog'] ?>);">Eliminar Post</span>
                                        </center>
                                    <?php

                                    }

                                    //Seleccionar si el usuario ya oprimio Like para mostrarle el Unlike
                                    $resultLikes = $connect->prepare("SELECT * FROM likes WHERE id_users = ".$session[0]['id_users']." AND id_posts = ".$row['id_blog'].";");
                                    $resultLikes->execute();
                                    $countLikes = $resultLikes->rowCount();

                                    if($countLikes == 1){ ?>
                                        <div id="status">
                                            <center>
                                                <span style="padding: 5px 1px;" class="btn btn-sm btn-danger btn-sm"><a data-id="<?php if(isset($row['id_blog'])){echo $row['id_blog'];} ?>" id="<?php if(isset($row['id_blog'])){echo $row['id_blog'];} ?>" style="color: #fff;padding: 5px 6px;">Unlike</a></span>
                                            </center>
                                        </div>
                                    <?php }else { ?>
                                        <div id="status">
                                            <center>
                                                <span style="padding: 5px 1px;" class="btn btn-sm btn-info btn-sm"><a data-id="<?php if(isset($row['id_blog'])){echo $row['id_blog'];} ?>" id="<?php if(isset($row['id_blog'])){echo $row['id_blog'];} ?>" style="color: #fff;padding: 5px 6px;">Like</a></span>
                                            </center>
                                        </div>
                                    <?php }
                                    
                                    if($row['img'] == null){
                                        echo '<a href="#Img" class="thumb pull-right">
                                                    <img src="../../Views/app/Img/security-hack.jpg" alt="Error" class="img-rounded">
                                                  </a>';
                                    }else{
                                        echo '<a href="#Img" class="thumb pull-right">
                                                    <img class="img-rounded" src="data:image/*;base64,'.base64_encode($row['img']).'" alt="ReadError">
                                                  </a>';
                                    }
                                    echo '<h2 class="post-title text-capitalize">'.$newtema.'</h2>';
                                    echo'<p><span class="post-fecha">'.$row['date'].'</span> <span class="post-title">by</span> <span class="post-autor">'.$row['autor'].'</span></p>';
                                    echo '<p class="post-content text-left">'.$newarticle."\n".'</p>';
                                }while($row = $stm->fetch(PDO::FETCH_ASSOC));

                        echo '</article>';
                    echo '</section>';
                echo '</div>';
        }
    }
}elseif ($count >= 0 && $search == ''){
    echo '<h2 class="text-capitalize text-danger"><center>Que estas búscando?</center></h2>';
}
else{
    echo '<center>No se encontro la búsqueda</center>';
}
