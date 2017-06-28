<?php

require_once '../Modelo/class.conection.php';
require_once '../Modelo/class.consultations.php';

session_start();
$consult    = new Consultations();
$sesion     = $consult->session();

$id_autor   = $sesion[0]['id_users'];
$autor      = $sesion[0]['users'];

//print_r($_FILES);
require_once '../library/resize.php';
if(isset($_POST['subirtwo']) && $_POST['subirtwo'] == 'Subirtwo'){

    //print_r($_FILES);
    if(isset($_FILES['file'])){
//            echo 'seguimos';

        $carpeta = '../../Views/app/Img/imgPost/';
        if(is_dir($carpeta) && is_writable($carpeta)){
            $result         = count($_FILES['file']['name']);
            $endExtension   = array('jpg','gif','png','jpeg');
            $msj            = '';

            for($i = 0; $i < $result; $i ++){
                $fileName       = $_FILES['file']['name'][$i];
                $fileTemp       = $_FILES['file']['tmp_name'][$i];

                $string         = substr(md5(uniqid(rand())),0,12);
                $nameNewFile    = $string . '.jpg';
                $thumbName      = 'thumb_' . $nameNewFile;
                $extencion      = pathinfo($fileName,PATHINFO_EXTENSION);
                $altName        = basename($fileName, '.' . $extencion);
                $fileInfo       = pathinfo($fileName);
                if(in_array($fileInfo['extension'],$endExtension)){
                    copy($fileTemp,$carpeta . $fileName);
                    $thumb = new thumbnail($carpeta . $fileName);
                    $thumb->size_width(1024);
                    $thumb->size_height(1024);
                    $thumb->jpeg_quality(1024);
                    $thumb->save($carpeta.$thumbName);

                    //Dimension imagen original
                    $thumb = new thumbnail($carpeta . $fileName);
                    $thumb->size_width(400);
                    $thumb->size_height(300);
                    $thumb->jpeg_quality(100);
                    $thumb->save($carpeta.$nameNewFile);
                    unlink($carpeta.$nameNewFile);

                    $categoria      = htmlentities(addslashes($_POST['categoria']));
                    $tema           = htmlentities(addslashes($_POST['tema']));
                    $articulo       = nl2br(htmlentities(addslashes($_POST['articulo'])));
                    $imagenBinario  = file_get_contents($fileTemp);
                    $date           = date('Y/m/d h:i:s a');

                    if(strlen($imagenBinario) > 0 && strlen($categoria) > 0 && strlen($tema) > 0 && strlen($autor) > 0 && strlen($articulo) > 0 && strlen($id_autor) > 0){
                        $modelo     = new Consultations();
                        $complete   = $modelo->insertPostUser($categoria,$tema,$articulo,$imagenBinario,$altName,$nameNewFile,$date,$autor,$id_autor);
                        $msj        = 5;
                    }
                }else{
                    $msj = 4;
                }
            }//Fin del bucle

            switch ($msj){
                case 4:
                    echo '4';
                    break;
                case 5:
                    echo '5';
                    break;
            }
            //Fin Switch

        }else{
//                echo 'La carpeta no tiene permisos';
            echo '3';
        }
    }else{
//            echo 'vacio';
        echo '2';
    }

}else{
    header('location: ../Acceso/index.php');
} // Fin de validacion