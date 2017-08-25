dit<?php
$npage = !is_numeric($_REQUEST['p']) ? 1 : $_REQUEST['p'];
$data = empty($data) ? array() : $data;

$form = array();
$form['title'] = 'Informacion de Usuario';
$items = array();

$items[] = array('type'=>'hidden', 'name'=>'entity[id]', 'value'=> $data['id'], id =>'id' );

$items[] = array('text'=>'Nombre', 'type'=>'text', 'name'=>'entity[nombre]', 'value'=> $data['nombre'], id =>'nombre', 'class' => 'col-md-6');

$items[] = array('text'=>'Apellidos', 'type'=>'text', 'name'=>'entity[apellidos]', 'value'=> $data['apellidos'], id =>'apellidos', 'class' => 'col-md-6');

$items[] = array('text'=>'Usuario', 'type'=>'text', 'name'=>'entity[usuario]', 'value'=> $data['usuario'], id =>'usuario','class' => 'col-md-6');

$items[] = array('text'=>'Password', 'type'=>'text', 'name'=>'entity[password]', 'value'=> $data['password'], id =>'password', 'class' => 'col-md-6');

$items[] = array('text'=>'Teléfono', 'type'=>'text', 'name'=>'entity[telefono]', 'value'=> $data['telefono'], id =>'telefono', 'class' => 'col-md-6');

$items[] = array('text'=>'Fecha de Captura', 'type'=>'text', 'name'=>'entity[fecha_captura]', 'value'=> $data['fecha_captura'], id =>'fecha_captura','class' => 'col-md-6');

$items[] = array('text'=>'Hora de Captura', 'type'=>'text', 'name'=>'entity[hora_captura]', 'value'=> $data['hora_captura'], id =>'hora_captura','class' => 'col-md-6');

$items[] = array('text'=>'Email', 'type'=>'text', 'name'=>'entity[email]', 'value'=> $data['email'], id =>'email','class' => 'col-md-6');

$items[] = array('text'=>'Twitter', 'type'=>'text', 'name'=>'entity[twitter]', 'value'=> $data['twitter'], id =>'twitter','class' => 'col-md-6');

$items[] = array('text'=>'Facebook', 'type'=>'text', 'name'=>'entity[facebook]', 'value'=> $data['facebook'], id =>'facebook','class' => 'col-md-6');

$items[] = array('text'=>'Instagram', 'type'=>'text', 'name'=>'entity[instagram]', 'value'=> $data['instagram'], id =>'instagram','class' => 'col-md-6');

$items[] = array('text'=>'Rol', 'type'=>'select', 'options'=>array('Admin'=>'Administrador','Usuario'=>'Usuario','Afiliado'=>'Afiliado'),'name'=>'entity[rol]', 'value'=> $data['rol'], id =>'rol','class' => 'col-md-6 selectContainer');

$items[] = array('text'=>'¿Mostrar en Home?', 'type'=>'select', 'options'=>array('No'=>'No','Si'=>'Si'),'name'=>'entity[in_front]', 'value'=> $data['in_front'], id =>'in_front','class' => 'col-md-6 selectContainer');

$items[] = array('text'=>'Status?', 'type'=>'select', 'options'=>array('Activo'=>'Activo','Inactivo'=>'Inactivo'),'name'=>'entity[status]', 'value'=> $data['status'], id =>'status','class' => 'col-md-6 selectContainer');

$items[] = array('text'=>'Imagen', 'type'=>'file', 'name'=>'entity[imagen]', 'value'=> $data['imagen'], id =>'imagen', 'class' => 'col-md-6');
$items[] = array('text'=>'Descripcion', 'type'=>'textarea', 'name'=>'entity[descripcion]', 'value'=> $data['descripcion'], id =>'descripcion', 'class' => 'col-md-6','style'=>'margin-bottom:10px; height: 200px;');

$form['items'] = $items;

$header_title = $cmd == 'add' ? 'Agregar Usuario' :  'Editar Usuario';



echo '<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="panel panel-light">
				<div class="panel-body">
		            <form action="" method="post" enctype="multipart/form-data" >';
						displayForm( $form);
						echo '<div class="form-group row gutter no-margin" style="float:right;">
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
