<?php

require_once '../Modelo/class.conection.php';
require_once '../Modelo/class.consultations.php';

function viewPost(){

    $connection = new Conection();
    $modelo     = new Consultations();
    $connect    = $connection->get_conection();
    $rowspost   = $modelo->viewPost();
    $countpost  = $modelo->viewCountPost();
    $viewCateg  = $modelo->viewCategorias();
    $total_post = count($countpost);
    $session    = $modelo->session();
    $incremPag  = 1;
    
    /*foreach ($viewCateg as $rowCateg) {
        echo "Categ: ".$rowCateg['nombre'],"<br>";        

        foreach ($rowspost as $rows) {
            if ($rows['id_categoria'] == $rowCateg['id']) {
                echo "Tema: ".$rows['tema'],"<br>";
            }
        }
    }*/

    if(isset($rowspost) and isset($viewCateg)){

        foreach ($viewCateg as $rowCateg) {
        echo "<h1 class='post-fecha post-h1 text-center'>".$rowCateg['nombre']."</h1>";
            foreach($rowspost as $rows){
                if ($rows['id_categoria'] == $rowCateg['id']) {
?>
            <?php
            if($session[0]['rango'] >= 2){ ?>
                <center>
                    <span style="cursor: pointer;" class="btn btn-sm btn-danger btn-sm" onclick="Confirm(<?php echo $rows['id_blog'] ?>);">Eliminar Post</span>
                </center>
            <?php } ?>
            <?php
            //Seleccionar si el usuario ya oprimio Like para mostrarle el Unlike
                $resultLikes = $connect->prepare("SELECT * FROM likes WHERE id_users = ".$session[0]['id_users']." AND id_posts = ".$rows['id_blog'].";");
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
                <li class="post clearfix" id="item-<?php echo $incremPag ?>">
                <!-- <h1 class="post-fecha post-h1"><?php /*echo $rowCateg['nombre']*/;?></h1> -->
                <?php
                    if($rows['img'] == null){ ?>
                        <a href="#Img" class="thumb pull-right">
                            <img src="../../Views/app/Img/803701665_122051.jpg" alt="Error" class="img-rounded">
                        </a>
                <?php }else{ ?>
                        <a href="../../Views/app/Img/imgPost/thumb_<?php echo $rows['name_img'] ?>" class="thumb pull-right" target="_blank">
                            <img class="img-rounded" src="../../Views/app/Img/imgPost/thumb_<?php echo $rows['name_img'] ?>" alt="ReadError">
                        </a>
                <?php } ?>
                <h2 class="post-title text-capitalize">
                    <?php
                        $tema = wordwrap($rows['tema'], 15, "\n", true);
                        echo $tema."\n";
                    ?>
                </h2>
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
                </li>
<?php
                    $incremPag++;
                }
            }
        }

?>
<?php 
    if($total_post >= 11){ ?>
        <li id="more-items">
            <center>
                <a class="btn btn-sm btn-success btn-sm" href="#more" onclick="loadContent(2,<?php echo $total_post ?>)" >
                    Cargar más...
                </a>
            </center>
        </li>
<?php
        }
    }
}
?>