<?php

require_once '../Modelo/class.conection.php';
require_once '../Modelo/class.consultations.php';


if(isset($_GET['id_users']) && !empty($_GET['id_users'])){
    $id_users   = htmlentities(addslashes($_GET['id_users']));
    $consult    = new Consultations();
    $connection = new Conection();
    $connect    = $connection->get_conection();
    $results    = $consult->viewUsersById($id_users);

    //Ver todos los mensajes que ah enviado, el usuario.
    $usersIdMsj = $results[0]['users'];
    $idMessage  = $connect->prepare("SELECT COUNT(message) FROM conversation WHERE user_name = '$usersIdMsj'");
    $idMessage->execute();
    $idMsj = $idMessage->fetch();
//    var_dump($results[0]['users']);

    if(isset($results) && !empty($results) && isset($idMsj) && !empty($idMsj)){
        foreach ($idMsj as $idMsjs){}
        foreach($results as $result){}

        include '../Include/header.php';
?>

<br><br><br>
<section class="main container">
    <div class="row">
        <section class="col-md-3">
                <div class="vistaUsers">
<?php
        $fecha1 = new DateTime($result['date_registry']);
        $fecha5 = new DateTime(date('Y/m/d h:i:s a'));
        $fecha = $fecha1->diff($fecha5);
?>

        <h1 class="text-center text-success">Perfíl</h1>
        <?php
        if($result['online'] == 1){ ?>
            <center><img src="../../Views/app/Img/connect.png"></center>
        <?php }else{ ?>
            <center><img src="../../Views/app/Img/disconnect.png"></center>
        <?php } ?>

        <br><center>
        <?php
        if(null == $result['foto_user']){
        ?>
            <img src="../../Views/app/Img/803701665_122051.jpg" alt="Error" class="imgPhoto">
        <?php }else{ ?>
            <img style="width: 100px;-webkit-border-radius: 5px;-moz-border-radius: 5px;border-radius: 5px;box-shadow: 1px 5px 10px #ffffff, 3px 15px 15px #000" src="data:image/*;base64,<?php echo base64_encode($result['foto_user']) ?>">
        <?php } ?>
        </center><br>
        <p><strong>Usuario:</strong> <?php echo $result['users'] ?></p>
        <p>
            <strong>Registrado El</strong><br><?php echo $result['date_registry'] ?><br>
            <br><strong>Tiempo Transcurrido:</strong>
            <?php
                if($fecha->y != 0){
            ?>
                <br><strong>Años <br> </strong>[{<?php echo  $fecha->y ?>}]
                <?php }else if($fecha->m != 0){ ?>
                <br><strong>Meses <br> </strong>[{<?php echo $fecha->m ?>}]
                <?php }else if($fecha->d != 0){ ?>
                <br><strong>Días <br> </strong>[{<?php echo  $fecha->d ?>}]
                <?php }else if($fecha->h != 0){ ?>
                <br><strong>Horas <br> </strong>[{<?php echo $fecha->h ?>}]
                <?php }else if($fecha->i != 0){ ?>
                <br><strong>Minutos <br> </strong>[{<?php echo  $fecha->i ?>}]
                <?php } ?>

        </p>

        <p><strong>Messages Sent:</strong> <?php echo $idMsjs[0]?></p>
        <?php
        if($result['rango'] == 0){ ?>
            <p><strong>Rango:</strong> <span style="color: #169c23;font-weight: bold; font-family: Courier,Arial,Verdana;"> {Usuario}</span></p>
        <?php }else if($result['rango'] == 1){ ?>
            <p><strong>Rango:</strong> <span style="color: #00b0ff;font-weight: bold; font-family: Courier,Arial,Verdana;"> [Moderador]</span></p>
        <?php }else if($result['rango'] == 2){ ?>
            <p><strong>Rango:</strong> <span style="color: #ff0000;font-weight: bold; font-family: Courier,Arial,Verdana;"> ..::Administrador::..</span></p>
        <?php } ?>
            </div>
        </section>
        <section class="col-md-9">
            <span class="user_online" id="<?php if(isset($user['id_users'])){echo $user['id_users'];}?>"></span>
            <form action="" method="post" enctype="multipart/form-data">
                <input type="hidden" name="select" value="desblock"/>
                <input type="submit" value="Desblock"/>
            </form>
            <form action="" method="post" enctype="multipart/form-data">
                <input type="hidden" name="select" value="block"/>
                <input type="submit" value="Block"/>
            </form>
            <aside id="users_online">
                <ul>
                    <?php
                    $pegaUsuarios = $connect->prepare("SELECT * FROM `users` WHERE `id_users` != ?");
                    $pegaUsuarios->execute(array($_SESSION['usuario']));

                    while($row  = $pegaUsuarios->fetch()){
                        $foto   = ($row['name_foto'] == null) ? 'default.jpg' : $row['name_foto'];
                        $block  = explode(',', $row['block']);
                        $ahora  = date('Y/m/d H:i:s a');

                        if(!in_array(isset($_SESSION['usuario']), $block)){
                            $status = $row['online'];
                    ?>
                    <li id="<?php if(isset($row['id_users'])){ echo $row['id_users'];}?>">
                        <div class="imgSmall">
                            <img src="../../Views/app/Img/ImgUsers/thumb_<? echo $foto?>" alt="Error"/>
                        </div>
                        <a href="#" id="<?php if(isset($row['id_users'])){ echo $_SESSION['usuario'].':'.$row['id_users'];}?>" class="conectado"><?php if(isset($row['users'])){ echo $row['users'];}?></a>
                        <span id="<?php if(isset($row['id_users'])){ echo $row['id_users'];}?>" >
                            <?php
                                if($status == 0){
                                    echo '<img class="status" src="../../Views/app/Img/disconnect.png" alt="Error">';
                                }else{
                                    echo '<img class="status" src="../../Views/app/Img/connect.png" alt="Error">';
                                }
                            ?>
                        </span>
                    </li>
                    <?php } } ?>
                    </ul>
            </aside>
        </section>
        <section class="col-md-12">
            <aside id="chats">

            </aside>
        </section>
    </div>
</section>
<?php
        include '../Include/footer.php';
    }else{
        header('location: index.php');
    }
}else{
    header('location: index.php');
}
?>