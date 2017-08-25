<?php 

$_total_data = empty($_total_data) ?  0 : $_total_data;
$config = empty($config) ? array() : $config;
$data = empty($data) ? array() : $data;

$buttons =array();

$buttons[] = array(
	'alt'=>'Editar', 'title'=>'Editar', 'img' => 'img/edit.gif',
	'href' => '?sec='.$_REQUEST['sec'].'&cmd=edit&id=[id_catalogo]',
	'hrefReplaceArr' => 
		array( 
			array('search' => '[id_catalogo]', 'field_replace' => 'id_catalogo' )
		)
);

$buttons[] = array(
	'alt'=>'Eliminar', 'title'=>'Eliminar', 'img' => 'img/delete.gif',
	'href' => '?sec='.$_REQUEST['sec'].'&cmd=delete&id=[id_catalogo]',
	'hrefReplaceArr' => 
		array( 
			array('search' => '[id_catalogo]', 'field_replace' => 'id_catalogo' )
		)
);



function categoria($categoria){
   $categoria = DB_INTERFACE_LoadById('categoria','id',$categoria['id_categoria']);
   return $categoria['nombre'];
}


$config['callFunctions'] = array('id_categoria' =>'categoria');


$config['actionButtons'] = $buttons;
$config['renameColumns'] = array('id_catalogo' =>'ID','atributo'=>'Atributo','unidad'=>'Unidad','type'=>'type','option'=>'option','id_categoria'=>'Categoria Principal');
//$config['hiddenColumns'] = array('id_categoria' ); 

$header_title = 'Atributos';

if( $_REQUEST['msj'] == 1 ){
	$header_msj_class = 'ok msj';
	$header_msj = 'Registro Categoria Guardado';
}
if( $_REQUEST['msj'] == 2 ){
	$header_msj_class = 'ok msj';
	$header_msj = 'Registro Categoria Eliminado';
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