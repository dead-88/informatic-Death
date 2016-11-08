<?php
//
//require_once '../Modelo/class.conection.php';
//
//$modelo = new Conection();
//$connect = $modelo->get_conection();
//
//$query_num_services =  "SELECT * FROM post"; $connect;
//$stm = $connect->prepare($query_num_services);
//$stm->execute();
//$num_total_registros = $stm->rowCount();
//
////Si hay registros
//if ($num_total_registros > 0) {
//    //numero de registros por página
//    $rowsPerPage = 5;
//
//    //por defecto mostramos la página 1
//    $pageNum = 1;
//
//    // si $_GET['page'] esta definido, usamos este número de página
//    if(isset($_GET['page'])) {
//        sleep(1);
//        $pageNum = $_GET['page'];
//    }
//
//    //contando el desplazamiento
//    $offset = ($pageNum - 1) * $rowsPerPage;
//    $total_paginas = ceil($num_total_registros / $rowsPerPage);
//
//    $query_services = "SELECT * FROM post ORDER BY id_blog DESC LIMIT '$offset','$rowsPerPage';"; $connect;
//    $stm = $connect->prepare($query_services);
//    $stm->execute();
//    while ($row_services = $stm->fetch()) {
//        //Mostramos los sevicios
//    }
//    if ($total_paginas > 1) {
//        echo '<div class="paginate">';
//        echo '<ul>';
//        if ($pageNum != 1)
//            echo '<li><a data="'.($pageNum-1).'">Anterior</a></li>';
//        for ($i=1;$i<=$total_paginas;$i++) {
//            if ($pageNum == $i)
//                //si muestro el índice de la página actual, no coloco enlace
//                echo '<li><a>'.$i.'</a></li>';
//            else
//                //si el índice no corresponde con la página mostrada actualmente,
//                //coloco el enlace para ir a esa página
//                echo '<li><a data="'.$i.'">'.$i.'</a></li>';
//        }
//        if ($pageNum != $total_paginas)
//            echo '<li><a data="'.($pageNum+1).'">Siguiente</a></li>';
//        echo '</ul>';
//        echo '</div>';
//    }
//}