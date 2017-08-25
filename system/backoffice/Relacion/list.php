<?php 

$_total_data = empty($_total_data) ?  0 : $_total_data;
$config = empty($config) ? array() : $config;
$data = empty($data) ? array() : $data;

$buttons =array();

/*$buttons[] = array(
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
);*/



function producto($producto){
   $producto = DB_INTERFACE_LoadById('producto','id',$producto['id_producto']);
   return $producto['producto'];
}
function catalogo($catalogo){
   $catalogo = DB_INTERFACE_LoadById('catalogo','id_catalogo',$catalogo['id_catalogo']);
   return $catalogo['atributo'];
}


$config['callFunctions'] = array('id_producto' =>'producto','id_catalogo' =>'catalogo');


$config['actionButtons'] = $buttons;
$config['renameColumns'] = array('id' =>'ID','id_producto'=>'Producto','id_catalogo'=>'Catalogo','valor'=>'Valor');
//$config['hiddenColumns'] = array('id_categoria' ); 

$header_title = 'Atributos';

if( $_REQUEST['msj'] == 1 ){
	$header_msj_class = 'ok msj';
	$header_msj = 'Registro Atributo Guardado';
}
if( $_REQUEST['msj'] == 2 ){
	$header_msj_class = 'ok msj';
	$header_msj = 'Registro atributo Eliminado';
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