<?php
//<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
require_once('../lib.php');
require_once("pasaporte.php");
require_once('../lib/controller.php');

$args = array();

//Archivo Controlador de Clase. 
//Obtiene los parametros de cotrolador
//tambien procesa resultados de ejecucion recibidos de mensajes del controlador
$args['controller_file'] = 'Blog.php';

$args['view_dir'] = 'Blog/';
$args['view_file'] = '';

$args['table_name_list'] = 'blog';
$args['table_name'] = 'blog';
$args['table_id'] = 'id';

$args['model_search_extra_conditions'] =array();
$args['model_select_fields'] = array('*');
$args['model_search_fields'] = array('titulo');

$args['cmd_show'] = 'blogs';
$args['seccion_title'] = 'Blog';

$args['o'] = 'id DESC';

$_REQUEST['k'] = 60;

$cmd =  $_REQUEST['cmd'];
switch( $cmd ){
	case 'save':
		
		$entity =  $_REQUEST['entity'];
	
		if( !empty($_FILES['imagen']['name']) ){
			$basename = substr(md5(basename($_FILES['imagen']['name'])),0,5);
			$ext = explode('.',basename($_FILES['imagen']['name']));
			$ext = array_reverse($ext);
			$ext =$ext[0];
			
			$img_name = date('YmdHis') . '_' . $basename .'.'. $ext;

			$tiposValidos = array('jpeg', 'jpg','gif', 'png');
			foreach($tiposValidos as $tipo){
				$tiposValidos[] = strtoupper($tipo);
			}
			$result = uploadFile( 'imagen', getImgDir('blog','imagen',0,0,false) . $img_name ,$tiposValidos );

			if($result > 0){
				$entity['imagen'] = $img_name;
			}
			
		}


/////////// Multiples imagenes
		
		if(isset($_FILES['file_array'])){

		    //almacenamos las propiedades de las imagenes
		    $name_array     = $_FILES['file_array']['name'];
		    $tmp_name_array = $_FILES['file_array']['tmp_name'];
		    $type_array     = $_FILES['file_array']['type'];
		    $size_array     = $_FILES['file_array']['size'];
		    $error_array    = $_FILES['file_array']['error'];
		    
		    $sec   = $_REQUEST["sec"];
		    $id   = $_REQUEST["id"];		    


		    //recorremos el array de imagenes para subirlas al simultaneo
		    for($i = 0; $i < count($tmp_name_array); $i++){


		    	    $basename = substr(md5(basename($name_array[$i])),0,5);
					$ext = explode('.',basename($name_array[$i]));
					$ext = array_reverse($ext);
					$ext =$ext[0];
					
					$img_name = date('YmdHis') . '_' . $basename .'.'. $ext;
					
		        if(move_uploaded_file($tmp_name_array[$i], "../files/images/".$img_name)){
		 
		            $act = "INSERT INTO `imas` (`nombre`, `seccion`, `sec_id`) VALUES ('".$img_name."', '".$sec."', '".$id."')";
		            @mysql_query($act);		           

		        }
		        else
		        {
		            //si ocurre algún problema 
		            echo "move_uploaded_file function failed for ".$img_name."<br>";
		        }
		    }
	}

///////////////////////////// finaliza multiples imagenes

///////////////////////////// Eliminar Imagenes

if (isset($_REQUEST['checkboximg'])) 
{
    
	foreach ($_REQUEST['checkboximg'] as $key => $value) {
		delImage($value);
	}

}


////////////////////////////// fin eliminar imagenes


	$args['entity'] = $entity;
	//debug($args['entity']);
	//die;
	break;
	default:break;
}
//debug($cmd);
//debug($args);
//die;
Controller_Execute($cmd, $args);
?>