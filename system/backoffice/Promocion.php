<?php
//<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
require_once('../lib.php');
require_once("pasaporte.php");
require_once('../lib/controller.php');

$args = array();

//Archivo Controlador de Clase. 
//Obtiene los parametros de cotrolador
//tambien procesa resultados de ejecucion recibidos de mensajes del controlador
$args['controller_file'] = 'Promocion.php';

$args['view_dir'] = 'Promocion/';
$args['view_file'] = '';

$args['table_name_list'] = 'promocion';
$args['table_name'] = 'promocion';
$args['table_id'] = 'id';

$args['model_search_extra_conditions'] =array();
$args['model_select_fields'] = array('*');
$args['model_search_fields'] = array('nombre');

$args['cmd_show'] = 'promociones';
$args['seccion_title'] = 'Promocion';

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
			$result = uploadFile( 'imagen', getImgDir('promocion','imagen',0,0,false) . $img_name ,$tiposValidos );

			if($result > 0){
				$entity['imagen'] = $img_name;
			}
			
		}
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