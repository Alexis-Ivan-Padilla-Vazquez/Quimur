<?php
require_once('system/lib.php');
$args['controller_file'] = 'Producto.php';
$args['view_dir'] = 'system/view/';
$args['table_name_list'] = 'producto';
$args['table_name'] = 'producto';
$args['table_id'] = 'id';
$args['model_select_fields']=array('*');
$args['model_search_fields'] = array('titulo','subtitulo');
$_REQUEST['o'] ='';
$extraConditions =array();
//debug($_REQUEST);
$cmd =  $_REQUEST['cmd'];
switch($cmd){
	default:
		$_REQUEST['k'] = 25;
		
		if(!empty($_REQUEST['cat'])){
			$extraConditions[] = 'categoria_producto_id = "'.$_REQUEST['cat'].'"';
		}
		$args['model_search_extra_conditions'] = $extraConditions;
		$args['view_file'] = 'ProductoMain.php';	
	break;
	case 'view':
		$args['view_file'] = 'ProductoView.php';	
		
	break;
}
Controller_Execute($cmd, $args);
?>