<?php

$data = empty($data) ? array() : $data;

$form = array();
$form['title'] = 'Información de la categoría';
$items = array();


$items[] = array('type'=>'hidden', 'name'=>'entity[id]', 'value'=> $data['id'], id =>'id' );
$items[] = array('text'=>'Nombre', 'type'=>'text', 'name'=>'entity[nombre]', 'value'=> $data['nombre'], id =>'nombre' );
$items[] = array('text'=>'Posicion', 'type'=>'text', 'name'=>'entity[posicion]', 'value'=> $data['posicion'], id =>'posicion' );

$categoria_productos = array();
$extraConditions = array();

$extraConditions[] = array('condition'=>'parent_id = 0 ', 'condition_values'=>array() );
$results = DB_INTERFACE_Select('categoria_producto',array('*'), $extraConditions, 'nombre ASC', 1, -1);

$categoria_productos[] = 'Seleccionada como Categoria_producto Principal';

foreach($results as $result){
	$categoria_productos[$result['id']] = $result['nombre'];


	$extraConditions = array();
	$extraConditions[] = array('condition'=>'parent_id = %s', 'condition_values'=>array($result['id']) );
	$results2 = DB_INTERFACE_Select('categoria_producto',array('*'), $extraConditions,
			array( 'order'=>'%s ASC', 'order_values'=>array('posicion') ),
		1, -1);

	foreach($results2 as $result2){
		$categoria_productos[$result2['id']] = '&nbsp;&nbsp;&nbsp;'.$result2['nombre'];
	}
}


$items[] = array('text'=>'Categoria_producto Principal', 'type'=>'select','options'=>$categoria_productos, 'name'=>'entity[parent_id]', 'value'=> $data['parent_id'], id =>'parent_id' );


$items[] = array('text'=>'Imagen', 'type'=>'file', 'name'=>'entity[imagen]', 'value'=> $data['imagen'], id =>'imagen', 'class' => 'col-md-12');

$form['items'] = $items;

$header_title = $cmd == 'add' ? 'Agregar Categoria_producto' :  'Editar Categoria_producto';

//require('header.php');
echo '<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="panel panel-light">
				<div class="panel-body">
		            <form action="" method="post" enctype="multipart/form-data" >';
						displayForm( $form);
						echo '<div class="form-group row gutter no-margin" style="float:right; margin-top:20px;">
								<div class="col-lg-12">
									<button type="submit" onClick="document.location.href=\'main.php?sec='.$_REQUEST['sec'].'\'" class="btn btn-danger"/>Cancelar</button>
									<button type="submit" class="btn btn-info">Guardar</button>
								</div>
							</div>';
						echo '<input type="hidden" name="cmd" value="save" />';
						echo '</div>';
					echo '</form>
				</div>
	    	</div>		
	    </div>
	  </div>';
?>
