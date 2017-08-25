<?php
$_total_data = empty($_total_data) ?  0 : $_total_data;
$config = empty($config) ? array() : $config;
$data = empty($data) ? array() : $data;

$npage = !is_numeric($_REQUEST['p']) ? 1 : $_REQUEST['p'];

$buttons =array();
$buttons[] = array(
	'alt'=>'Editar', 'title'=>'Editar', 'img' => 'img/edit.gif',
	'href' => '?sec='.$_REQUEST['sec'].'&cmd=edit&id=[id]',
	'hrefReplaceArr' => 
		array( 
			array('search' => '[id]', 'field_replace' => 'id' )
		)
);

$buttons[] = array(
	'alt'=>'Eliminar', 'title'=>'Eliminar', 'img' => 'img/delete.gif',
	'href' => '?sec='.$_REQUEST['sec'].'&cmd=delete&id=[id]',
	'hrefReplaceArr' => 
		array( 
			array('search' => '[id]', 'field_replace' => 'id' )
		)
);

function imagen($imagen){
	//debug($imagen['imagen']);
	return '<img src="../../system/files/images/'.$imagen['imagen'].'" style="width:50px;" />';
	
}
	
$config['callFunctions'] = array('imagen' =>'imagen');

$config['actionButtons'] = $buttons;
$config['renameColumns'] = array('id' =>'ID','nombre' =>'Nombre','apellidos' =>'Apellidos','usuario' =>'Usuario','password' =>'Password','telefono' =>'Teléfono','fecha_captura' =>'Fecha de captura','hora_captura' =>'Hora de captura','email' =>'Email','rol' =>'Rol','imagen' =>'imagen','status' =>'Estatus','in_front' =>'¿Mostrar en Home?');
$config['hiddenColumns'] = array('id','fecha_captura','hora_captura','descripcion','twitter','facebook','instagram'); 

$header_title = 'Usuarios';

if( $_REQUEST['msj'] == 1 ){
	$header_msj_class = 'ok msj';
	$header_msj = 'Registro Usuario Guardado';
}
if( $_REQUEST['msj'] == 2 ){
	$header_msj_class = 'ok msj';
	$header_msj = 'Registro Usuario Eliminado';
}
?>
	<div class="row gutter">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="panel panel-light">
					<div class="panel-body">
						<div class="table-responsive">
							<?php displayDataTable( $_total_data, $data, $config); ?>
						</div>
					</div>
			</div>
		</div>
	</div>


