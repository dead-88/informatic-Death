<?php

//print_r($_POST['conversacion']);

    require_once '../Modelo/class.conection.php';
    require_once '../Modelo/class.consultations.php';

    if(isset($_POST['conversacion'])) {
        $connection = new Conection();
        $consultas  = new Consultations();
        $connect    = $connection->get_conection();

        $messages    = array();
        $id_conver  = (int)htmlentities(addslashes($_POST['conversacion']));
        $online     = (int)htmlentities(addslashes($_POST['online']));

        $pegaConv   = $connect->prepare("SELECT * FROM `messages` WHERE (`id_de` = ? AND `id_para` = ?) OR (`id_de` = ? AND `id_para` = ?) ORDER BY `id` DESC LIMIT 10");
        $pegaConv->execute(array($online,$id_conver,$id_conver, $online));

        while($row = $pegaConv->fetch()){
            $fotouser = '';
            if($online == $row['id_de']){
                $janela_de = $row['id_para'];

            }elseif($online == $row['id_para']){
                $janela_de = $row['id_de'];

                $pegaFoto = $connect->prepare("SELECT `name_foto` FROM `users` WHERE `id_users` = '$row[id_de]'");
                $pegaFoto->execute();

                while($usr = $pegaFoto->fetch()){
                    $fotouser = ($usr['name_foto'] == '') ? 'default.jpg' : $usr['name_foto'];
                }
            }

            $emotions   = array(';)', ':)', ':(', '8)', ':@', ':3', ':D', '0_0', '<3', ':*', '*-*', '*_*', '(y)', ':p', '-.-', "-_-", ':!', ':|', '>.>', '>_>', '>p>', '>(>');
            $imgs       = array(
                '<img class="img-rounded" src="../../Views/app/Img/Emoticons/wink.png" width="18"/>',               //picaro
                '<img class="img-rounded" src="../../Views/app/Img/Emoticons/happy.png" width="18"/>',              //feliz
                '<img class="img-rounded" src="../../Views/app/Img/Emoticons/feelingbad.png" width="18"/>',         //triste
                '<img class="img-rounded" src="../../Views/app/Img/Emoticons/persons-0041_medium.png" width="18"/>',//cool
                '<img class="img-rounded" src="../../Views/app/Img/Emoticons/persons-0054_medium.png" width="18"/>',//asombro
                '<img class="img-rounded" src="../../Views/app/Img/Emoticons/sleepyembarrazed.png" width="18"/>',   //alagado
                '<img class="img-rounded" src="../../Views/app/Img/Emoticons/happy2.png" width="18"/>',             //feliz2
                '<img class="img-rounded" src="../../Views/app/Img/Emoticons/O_O.png" width="18"/>',                //asombro
                '<img class="img-rounded" src="../../Views/app/Img/Emoticons/persons-0173_medium.png" width="18"/>',//corazon
                '<img class="img-rounded" src="../../Views/app/Img/Emoticons/kissheart.png" width="18"/>',          //beso
                '<img class="img-rounded" src="../../Views/app/Img/Emoticons/loveface.png" width="18"/>',           //enamorado
                '<img class="img-rounded" src="../../Views/app/Img/Emoticons/persons-0076_medium.png" width="18"/>',//GatoEnamorado
                '<img class="img-rounded" src="../../Views/app/Img/Emoticons/persons-0106_medium.png" width="18"/>',//Like
                '<img class="img-rounded" src="../../Views/app/Img/Emoticons/winktongue.png" width="18"/>',         //travieso
                '<img class="img-rounded" src="../../Views/app/Img/Emoticons/persons-0058_medium.png" width="18"/>',//serio
                '<img class="img-rounded" src="../../Views/app/Img/Emoticons/persons-0035_medium.png" width="18"/>',//enojado
                '<img class="img-rounded" src="../../Views/app/Img/Emoticons/persons-0053_medium.png" width="18"/>',//Mmmmmm
                '<img class="img-rounded" src="../../Views/app/Img/Emoticons/persons-0055_medium.png" width="18"/>',//Cricricri
                '<img class="img-rounded" src="../../Views/app/Img/Emoticons/persons-0037_medium.png" width="18"/>',//NoLike
                '<img class="img-rounded" src="../../Views/app/Img/Emoticons/persons-0030_medium.png" width="18"/>',//GanasDellorar
                '<img class="img-rounded" src="../../Views/app/Img/Emoticons/loltongue.png" width="18"/>',          //SacarLengüa
                '<img class="img-rounded" src="../../Views/app/Img/Emoticons/dontsee.png" width="18"/>'             //Desepcion
            );
            $msg            = str_replace($emotions, $imgs, htmlentities(addslashes($row['message'])));
            $linkHttp       = $consultas->link($msg);
            $newlinkHttp    = wordwrap($linkHttp, 10, "\n", true);
            $messages[]     = array(
                'id'        => $row['id'],
                'message'   => utf8_encode($newlinkHttp."\n"),
                'name_foto' => $fotouser,
                'id_de'     => $row['id_de'],
                'id_para'   => $row['id_para'],
                'janela_de' => $janela_de
            );
        }
        die( json_encode($messages) );
    }