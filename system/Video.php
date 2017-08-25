<?php
require_once('system/lib.php');
$args['controller_file'] = 'Video.php';
$args['view_dir'] = 'system/view/';
$args['table_name_list'] = 'video';
$args['table_name'] = 'video';
$args['table_id'] = 'id';
$args['model_select_fields']=array('*');
$args['model_search_fields'] = array('titulo','subtitulo','contenido');
$_REQUEST['o'] ='fecha DESC';
$extraConditions =array();
//debug($_REQUEST);
$cmd =  $_REQUEST['cmd'];
switch($cmd){
	default:
		$_REQUEST['k'] = 25;
		
		if(!empty($_REQUEST['cat'])){
			$extraConditions[] = 'categoria_id = "'.$_REQUEST['cat'].'"';
		}

		$extraConditions[] = 'status = "Activo"';

		$args['model_search_extra_conditions'] = $extraConditions;
		$args['view_file'] = 'VideoMain.php';	
	break;
	case 'view':
		$args['view_file'] = 'VideoView.php';	
		
	break;
}
Controller_Execute($cmd, $args);
?>