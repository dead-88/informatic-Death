<?php

require_once '../Modelo/class.conection.php';
require_once '../Modelo/class.consultations.php';

function viewPost(){

    $connection = new Conection();
    $modelo     = new Consultations();
    $connect    = $connection->get_conection();
    $rowspost   = $modelo->viewPost();
    $session    = $modelo->session();

    if(isset($rowspost)){
        foreach($rowspost as $rows){
?>
            <?php
            if($session[0]['rango'] >= 2){ ?>
                <center>
                    <span style="cursor: pointer;" class="btn btn-sm btn-danger btn-sm" onclick="Confirm(<?php echo $rows['id_blog'] ?>);">Eliminar Post</span>
                </center>
            <?php } ?>
                    <?php
                    //Seleccionar si el usuario ya oprimio Like para mostrarle el Unlike
                        $resultLikes = $connect->prepare("SELECT * FROM likes WHERE id_users = ".$session[0]['id_users']." AND id_posts =".$rows['id_blog'].";");
                        $resultLikes->execute();
                        $countLikes = $resultLikes->rowCount();
                        if($countLikes == 1){ ?>
                            <div id="status">
                                <center>
                                    <span style="padding: 5px 1px;" class="btn btn-sm btn-danger btn-sm"><a data-id="<?php if(isset($rows['id_blog'])){echo $rows['id_blog'];} ?>" id="<?php if(isset($rows['id_blog'])){echo $rows['id_blog'];} ?>" style="color: #fff;padding: 5px 6px;">Unlike</a></span>
                                </center>
                            </div>
                        <?php }else { ?>
                            <div id="status">
                                <center>
                                    <span style="padding: 5px 1px;" class="btn btn-sm btn-info btn-sm"><a data-id="<?php if(isset($rows['id_blog'])){echo $rows['id_blog'];} ?>" id="<?php if(isset($rows['id_blog'])){echo $rows['id_blog'];} ?>" style="color: #fff;padding: 5px 6px;">Like</a></span>
                                </center>
                            </div>
                        <?php } ?>
                    <?php
                    $id_userOn = $session[0]['id_users'];
                    //Si existe el metodo post like inserte en la base de datos el id del usuario y el id del post
                        if(isset($_POST['like'])){
                            $postid     = (int)htmlentities(addslashes($_POST['postsid']));
                            $resultIns  = $connect->prepare("SELECT * FROM post WHERE id_blog = $postid");
                            $resultIns->execute();
                            $rowLike    = $resultIns->fetch();
                            $number     = $rowLike['likes'];

                            $stmOne     = $connect->prepare("UPDATE post SET likes = $number+1 WHERE id_blog = $postid");
                            $stmOne->execute();
                            $stmTwo     = $connect->prepare("INSERT INTO likes(id_users,id_posts) VALUES(".$id_userOn.", $postid)");
                            $stmTwo->execute();
                            exit();
                        }
                        //Si existe el metodo post unlike elimine en la base de datos el id del usuario y el id del post
                        if(isset($_POST['unlike'])){
                            $postid     = (int)htmlentities(addslashes($_POST['postsid']));
                            $resultIns  = $connect->prepare("SELECT * FROM post WHERE id_blog = $postid");
                            $resultIns->execute();
                            $rowLike    = $resultIns->fetch();
                            $number     = $rowLike['likes'];

                            $stmTwo     = $connect->prepare("DELETE FROM likes WHERE id_posts = $postid AND id_users = ".$id_userOn.";");
                            $stmTwo->execute();
                            $stmOne     = $connect->prepare("UPDATE post SET likes = $number-1 WHERE id_blog = $postid");
                            $stmOne->execute();
                            exit();
                        }
                    ?>
                    <article class="post clearfix">
                        <h1 class="post-fecha post-h1"><?php echo $rows['nombre'];?></h1>
                        <?php
                            if($rows['img'] == null){ ?>
                                <a href="#Img" class="thumb pull-right">
                                    <img src="../../Views/app/Img/803701665_122051.jpg" alt="Error" class="img-rounded">
                                </a>
                        <?php }else{ ?>
                                <a href="#Img" class="thumb pull-right">
                                    <img class="img-rounded" src="data:image/*;base64,<?php echo base64_encode($rows['img']); ?>" alt="ReadError">
                                </a>
                        <?php } ?>
                        <h2 class="post-title text-capitalize"><?php echo $rows['tema']; ?></h2>
                    <p>
                        <span class="post-fecha"><?php echo $rows['date'] ?></span>
                        <span class="post-title">by</span> 
                        <span class="post-autor"><?php echo $rows['autor'] ?></span>
                    </p>
            <p class="post-content text-left">
                <?php
                    $article    = nl2br($rows['article']);
                    $targetHttp = $modelo->link($article);
                    $newarticle = wordwrap($targetHttp, 32, "\n", true);
                    echo $newarticle."\n";
                ?>
            </p>
            </article>
        <?php } } } ?>