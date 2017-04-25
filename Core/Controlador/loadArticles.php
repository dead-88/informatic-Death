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
                    <span style="cursor: pointer;" class="btn btn-danger" onclick="Confirm(<?php echo $rows['id_blog'] ?>);">Eliminar Post</span>
                </center>
            <?php } ?>
                    <?php
                        $resultLikes = $connect->prepare("SELECT * FROM likes WHERE id_users = ".$session[0]['id_users']." AND id_posts =".$rows['id_blog'].";");
                        $resultLikes->execute();
                        $countLikes = $resultLikes->rowCount();
                        if($countLikes == 1){ ?>
                            <center>
                                <a id="<?php if($rows['id_blog']){echo $rows['id_blog'];} ?>" style="cursor: pointer;" class="unlike btn btn-info">No Megusta</a>
                            </center>
                        <?php }else { ?>
                            <center>
                                <a id="<?php if($rows['id_blog']){echo $rows['id_blog'];} ?>" style="cursor: pointer;" class="like btn btn-info">Me gusta</a>
                            </center>
                        <?php } ?>
                    <?php
                    $id_userOn = $session[0]['id_users'];
                        if(isset($_POST['like'])){
                            $postid     = (int)htmlentities(addslashes($_POST['postsid']));
                            $resultIns  = $connect->prepare("SELECT * FROM post WHERE id_blog = $postid");
                            $resultIns->execute();
                            $rowLike    = $resultIns->fetch();
                            $number     = $rowLike['likes'];

                            $stmOne     = $connect->prepare("UPDATE post SET likes = $number+1 WHERE id = $postid");
                            $stmOne->execute();
                            $stmTwo     = $connect->prepare("INSERT INTO likes(id_users,id_posts) VALUES(".$id_userOn.", $postid)");
                            $stmTwo->execute();
                            exit();
                        }

                    if(isset($_POST['unlike'])){
                        $postid     = (int)htmlentities(addslashes($_POST['postsid']));
                        $resultIns  = $connect->prepare("SELECT * FROM post WHERE id_blog = $postid");
                        $resultIns->execute();
                        $rowLike    = $resultIns->fetch();
                        $number     = $rowLike['likes'];

                        $stmTwo     = $connect->prepare("DELETE FROM likes WHERE id_posts = $postid AND id_users = ".$id_userOn.";");
                        $stmTwo->execute();
                        $stmOne     = $connect->prepare("UPDATE post SET likes = $number-1 WHERE id = $postid");
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
            <p class="post-content text-left"><?php echo $rows['article'] ?></p>
            </article>
        <?php } } } ?>