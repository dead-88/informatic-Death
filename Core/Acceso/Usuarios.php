<?php

require_once '../Modelo/class.conection.php';
require_once '../Modelo/class.consultations.php';


if(isset($_GET['id_users']) && !empty($_GET['id_users'])){
    $id_users   = htmlentities(addslashes($_GET['id_users']));
    $consult    = new Consultations();
    $connection = new Conection();
    $connect    = $connection->get_conection();
    $results    = $consult->viewUsersById($id_users);

    //Ver todos los mensajes que a enviado el usuario en la pagina principal.
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

<section class="main container">
    <div class="row">
        <section class="col-md-4">
            <div class="vistaUsers">
                <?php
                    $fecha1 = new DateTime($result['date_registry']);
                    $fecha5 = new DateTime(date('Y/m/d h:i:s a'));
                    $fecha = $fecha1->diff($fecha5);
                ?>

                <h1 class="text-center post-title">Perfíl</h1>
                <br>
                <center>
                    <?php
                    if(null == $result['foto_user']){
                    ?>
                        <img src="../../Views/app/Img/security-hack.jpg" alt="Error" class="imgPhoto">
                    <?php }else{ ?>
                        <img style="width: 100px;-webkit-border-radius: 5px;-moz-border-radius: 5px;border-radius: 5px;box-shadow: 1px 5px 10px #ffffff, 3px 15px 15px #000" src="data:image/*;base64,<?php echo base64_encode($result['foto_user']) ?>">
                    <?php } ?>
                </center>
                <br>
                <p>
                    <strong>Usuario:</strong> <?php echo $result['users'] ?>
                </p>
                <p>
                    <strong>Día de registro:</strong>
                    <br>
                    <?php echo $result['date_registry'] ?>
                    <br>
                    <br>
                    <strong>Tiempo Transcurrido:</strong>
                    <?php if($fecha->y != 0){ ?>
                    <br><strong>Años<br></strong>[{<?php  echo $fecha->y ?>}]
                    <?php } if($fecha->m != 0){ ?>
                    <br><strong>Meses<br></strong>[{<?php echo $fecha->m ?>}]
                    <?php } if($fecha->d != 0){ ?>
                    <br><strong>Días<br></strong>[{<?php  echo $fecha->d ?>}]
                    <?php } if($fecha->h != 0){ ?>
                    <br><strong>Horas<br></strong>[{<?php echo $fecha->h ?>}]
                    <?php } if($fecha->i != 0){ ?>
                    <br><strong>Minutos<br></strong>[{<?php echo $fecha->i ?>}]
                    <?php } ?>
                </p>

                <p>
                    <strong>Messages Sent:</strong> 
                    <?php echo $idMsjs[0]?>
                </p>
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
        <section class="col-md-4">
        <a href="#viewUnlock" id="unlock1" class="btn btn-info btn-sm">Desbloquear usuarios</a>
        <a href="#viewlock" id="lock1" class="btn btn-info btn-sm">Bloquear usuarios</a>
            <div class="vistaUsers unlock1" style="display: none;">
                <?php
                    $bloqueados = $user[0]['block'];
                    if($bloqueados != 0){
                ?>
                    <form id="unlock" name="unlock" method="post" enctype="multipart/form-data">
                    <div id="_UNLOCK_"></div>
                        <?php

                            if($bloqueados){
                                $persBlock  = $connect->prepare("SELECT `id_users`,`block`,`users` FROM `users` WHERE `id_users` IN($bloqueados)");
                                $persBlock->execute();
                                while($block = $persBlock->fetch()){
                                    echo '<span>
                                            <input class="checkboxu" type="checkbox" name="desblock[]" value="'.$block['id_users'].'"/>'.utf8_encode($block['users']).'
                                        </span>
                                        <br/>';
                                }
                            }
                        ?>
                        <input type="hidden" name="select" value="desblock"/>
                        <button onclick="return unlockUsers()" type="submit" value="Desbloquear" class="btn btn-sm btn-primary btn-sm">Desbloquear</button>
                    </form>
                <?php } ?>
            </div>
            <br>
            <div class="vistaUsers lock1" style="display: none;">
                <form id="lock" name="lock" method="post" enctype="multipart/form-data">
                <div id="_LOCK_"></div>
                    <?php
                        $arrayBlock = explode(',', $bloqueados);
                        $usersDesbl = $connect->prepare("SELECT * FROM `users` WHERE `id_users` != ?");
                        $usersDesbl->execute(array($_SESSION['id_user']));
                        while($desblo = $usersDesbl->fetch()){
                            if(!in_array($desblo['id_users'], $arrayBlock)){
                                echo '<span>
                                        <input class="checkboxu" type="checkbox" name="block[]" value="'.$desblo['id_users'].'"/>'.utf8_encode($desblo['users']).'
                                    </span>
                                    <br/>';
                            }
                        }
                    ?>
                    <input type="hidden" name="select" id="select" value="block"/>
                    <button onclick="return lockUsers()" type="submit" value="Bloquear" class="btn btn-sm btn-primary btn-sm">Bloquear</button>
                </form>
            </div>
        </section>
        <section class="col-md-4">
            <span class="user_online" id="<?php if(isset($user[0]['id_users'])){echo $user[0]['id_users'];}?>"></span>
            <aside id="users_online">
                <ul>
                    <?php
                    $pegaUsuarios = $connect->prepare("SELECT * FROM `users` WHERE `id_users` != ?");
                    $pegaUsuarios->execute(array($_SESSION['id_user']));

                    while($row  = $pegaUsuarios->fetch()){
                        $foto   = ($row['name_foto'] == null) ? 'default.jpg' : $row['name_foto'];
                        $block  = explode(',', $row['block']);
                        $ahora  = date('Y-m-d H:i:s');

                        if(!in_array($_SESSION['id_user'], $block)){
                            $status = 'connect';
                            if($ahora >= $row['limite']){
                                $status = 'disconnect';
                            }
                    ?>
                    <li id="<?php if(isset($row['id_users'])){ echo $row['id_users'];}?>">
                        <div class="imgSmall">
                            <img src="../../Views/app/Img/ImgUsers/thumb_<? echo $foto?>" alt="Error"/>
                        </div>
                        <a href="#user" id="<?php if(isset($row['id_users'])){ echo $_SESSION['id_user'].':'.$row['id_users'];}?>" class="conectado"><?php if(isset($row['users'])){ echo $row['users'];}?>
                        </a>
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
    </div>
</section>
<section class="col-md-12">
    <div class="row">
        <aside id="chats">

        </aside>
    </div>
</section>
<footer>
    <div class="color-footer col-xs-12">
        <p class="text-center">Copyright &COPY; <?php echo date("Y"); ?> Created By Death_*88 & BL0CK_LT3 <strong>Team Security-Hack</strong></p>
    </div>
</footer>
<script type="text/javascript" src="../../Views/app/Js/jquery.js"></script>
<script type="text/javascript" src="../../Views/app/Js/bootstrap.js"></script>
<script type="text/javascript" src="../../Views/app/Js/functions.js"></script>
<script type="text/javascript" src="../../Views/app/Js/visto_play.js"></script>
<script type="text/javascript" src="../../Views/app/Js/mdb.min.js"></script>
<script type="text/javascript" src="../../Views/app/Js/disenos.js"></script>
<script type="text/javascript">

function lockUsers(){
    var form = document.lock;
    var dataString = $(form).serialize();
    //console.log(dataString)

    $.ajax({
        type    :'POST',
        url     :'../Controlador/lockUnlock.php',
        data    : dataString,
        success : function(data){
            $('#_LOCK_').html(data);
            setTimeout(function(){
                location.reload();
            },2000);
        }
    });
    return false;
}

function unlockUsers(){
    var form = document.unlock;
    var dataString = $(form).serialize();
    //console.log(dataString)

    $.ajax({
        type    :'POST',
        url     :'../Controlador/lockUnlock.php',
        data    : dataString,
        success : function(data){
            $('#_UNLOCK_').html(data);
            setTimeout(function(){
                location.reload();
            },2000);
        }
    });
    return false;
}
</script>
<?php
    }else{
        header('location: index.php');
    }
}else{
    header('location: index.php');
}
?>