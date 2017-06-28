<?php 
	require_once '../Modelo/class.conection.php';
	require_once '../Modelo/class.consultations.php';


	session_start();
	$page 		= htmlentities(addslashes($_GET['p']));
	$start		= ($page-1) * 10;
	$conection 	= new Conection();
	$consult 	= new Consultations();
	$connect 	= $conection->get_conection();
	$session 	= $consult->session();
	$id_userOn 	= $session[0]['id_users'];
	$rango 		= $session[0]['rango'];

	$query = $connect->prepare("SELECT * FROM post,categorias WHERE post.id_categoria = categorias.id ORDER BY post.id_blog DESC LIMIT $start,10");
	$query->execute();
	$countPost = $query->rowCount();

	$array = array();
	if($countPost > 0){
		while ($contentPag = $query->fetch()) {
			$article    = nl2br($contentPag['article']);
            $targetHttp = $consult->link($article);
            $newarticle = wordwrap($targetHttp, 		32, "\n", true);
            $newtema 	= wordwrap($contentPag['tema'], 15,"\n", true);

            if($rango >= 2){
                $delPost = '<center>
	                			<span style="cursor: pointer;" class="btn btn-sm btn-danger btn-sm" onclick="Confirm('.$contentPag['id_blog'].');">Eliminar Post
	                			</span>
                			</center>';
            }else{
            	$delPost = '';
            }

            //Seleccionar si el usuario ya oprimio Like para mostrarle el Unlike
                $resultLikes = $connect->prepare("SELECT * FROM likes WHERE id_users = ".$id_userOn." AND id_posts = ".$contentPag['id_blog'].";");
                $resultLikes->execute();
                $countLikes = $resultLikes->rowCount();
                $status = "";

                if($countLikes == 1){
                    $status = '<div id="status">
		                        <center>
		                            <span style="padding: 5px 1px;" class="btn btn-sm btn-danger btn-sm waves-effect waves-light"><a data-id="'.$contentPag['id_blog'].'" id="'.$contentPag['id_blog'].'" style="color: #fff;padding: 5px 6px;">Unlike</a></span>
		                        </center>
		                    </div>';
                }else { 
                    $status = '<div id="status">
		                        <center>
		                            <span style="padding: 5px 1px;" class="btn btn-sm btn-info btn-sm waves-effect waves-light"><a data-id="'.$contentPag['id_blog'].'" id="'.$contentPag['id_blog'].'" style="color: #fff;padding: 5px 6px;">Like</a></span>
		                        </center>
		                    </div>';
                }

			$array[] = array(
					"id_blog" 	=> $contentPag['id_blog'],
					"categoria"	=> $contentPag['nombre'],
					"tema" 		=> $newtema."\n",
					"article" 	=> $newarticle."\n",
					"name_img" 	=> $contentPag['name_img'],
					"date" 		=> $contentPag['date'],
					"autor" 	=> $contentPag['autor'],
					"id_autor"  => $contentPag['id_autor'],
					"like" 		=> $contentPag['likes'],
					"DelPost" 	=> $delPost,
					"status"	=> $status,
				);
		}
		echo ''. json_encode( $array ) .'';
	}
?>