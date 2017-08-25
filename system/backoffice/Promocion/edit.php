<?php
$npage = !is_numeric($_REQUEST['p']) ? 1 : $_REQUEST['p'];
$data = empty($data) ? array() : $data;
$form = array();
$form['title'] = 'Informacion de Promocion';
$items = array();
$items[] = array('type'=>'hidden', 'name'=>'entity[id]', 'value'=> $data['id'], id =>'id' );
$items[] = array('text'=>'Nombre', 'type'=>'text', 'name'=>'entity[nombre]', 'value'=> $data['nombre'], id =>'nombre', 'class' => 'col-md-6');
$items[] = array('text'=>'Descripcion', 'type'=>'textarea', 'name'=>'entity[descripcion]', 'value'=> $data['descripcion'], id =>'descripcion','class' => 'col-md-12','style'=>'margin-bottom:10px; height: 200px;');
$items[] = array('text'=>'Fecha', 'type'=>'date', 'name'=>'entity[fecha]', 'value'=> $data['fecha'], id =>'fecha', 'class' => 'col-md-6');
$items[] = array('text'=>'Imagen', 'type'=>'file', 'name'=>'entity[imagen]', 'value'=> $data['imagen'], id =>'imagen', 'class' => 'col-md-6');
$items[] = array('text'=>'Status?', 'type'=>'select', 'options'=>array('Activo'=>'Activo','Inactivo'=>'Inactivo'),'name'=>'entity[status]', 'value'=> $data['status'], id =>'status','class' => 'col-md-6 selectContainer');

$form['items'] = $items;
$header_title = $cmd == 'add' ? 'Agregar Promocion' :  'Editar Promocion';
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
