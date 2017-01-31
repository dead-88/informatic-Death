<?php

sleep(1);

require_once '../Modelo/class.conection.php';
require_once '../Modelo/class.consultations.php';

//print_r($_FILES);
require_once $_SERVER['DOCUMENT_ROOT'] . '/informatic-Death/Core/library/resize.php';
if(isset($_POST['subir']) && $_POST['subir'] == 'Subir'){

    //print_r($_FILES);
    if(isset($_FILES['file'])){
//            echo 'seguimos';

        $modelo     = new Consultations();

        $carpeta = $_SERVER['DOCUMENT_ROOT'] . '/informatic-Death/Views/app/Img/imgPost/';
        if(is_dir($carpeta) && is_writable($carpeta)){
            $result = count($_FILES['file']['name']);
            $endExtension = array('jpg','gif','png','jpeg');
            $msj = '';

            for($i = 0; $i < $result; $i ++){
                $fileName = $_FILES['file']['name'][$i];
                $fileTemp = $_FILES['file']['tmp_name'][$i];

                $string = substr(md5(uniqid(rand())),0,12);
                $nameNewFile = $string . '.jpg';
                $thumbName = 'thumb_' . $nameNewFile;
                $extencion = pathinfo($fileName,PATHINFO_EXTENSION);
                $altName = basename($fileName, '.' . $extencion);
                $fileInfo = pathinfo($fileName);
                if(in_array($fileInfo['extension'],$endExtension)){
                    //
                    /**
                     * Creando thumnails, y redireccionando las imagenes originales
                     */
                    copy($fileTemp,$carpeta . $fileName);
                    $thumb = new thumbnail($carpeta . $fileName);
                    $thumb->size_width(100);
                    $thumb->size_height(100);
                    $thumb->jpeg_quality(88);
                    $thumb->save($carpeta.$thumbName);
                    //Dimension imagen original
                    $thumb = new thumbnail($carpeta . $fileName);
                    $thumb->size_width(400);
                    $thumb->size_height(300);
                    $thumb->jpeg_quality(100);
                    $thumb->save($carpeta.$nameNewFile);
                    unlink($carpeta.$nameNewFile);

                    $categoria = htmlentities(addslashes($_POST['categoria']));
                    $tema = htmlentities(addslashes($_POST['tema']));
                    $articulo = htmlentities(addslashes($_POST['articulo']));
                    $imagenBinario  = addslashes(file_get_contents($fileTemp));
                    $autor = htmlentities(addslashes($_POST['autor']));
                    $date = date('Y/m/d h:i:s a');
                    $ip = $_SERVER['REMOTE_ADDR'];

                    if(strlen($imagenBinario) > 0 && strlen($categoria) > 0 && strlen($tema) > 0 && strlen($autor) > 0 && strlen($articulo) > 0){
                        $modelo = new Consultations();
                        $complete = $modelo->insertPost($categoria,$tema,$articulo,$imagenBinario,$altName,$nameNewFile,$date,$autor,$ip);
                        echo 1;
                    }

                }

            }//Fin del bucle
        }
    }

}else{
    header('location: ../../CoreRoot/Admin/blog.php');
} // Fin de validacion