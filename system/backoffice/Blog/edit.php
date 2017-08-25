<?php
$npage = !is_numeric($_REQUEST['p']) ? 1 : $_REQUEST['p'];
$data = empty($data) ? array() : $data;
$form = array();
$form['title'] = 'Informacion de Blog';
$items = array();
$items[] = array('type'=>'hidden', 'name'=>'entity[id]', 'value'=> $data['id'], id =>'id');
$items[] = array('type'=>'hidden', 'name'=>'entity[user_id]', 'value'=> $_SESSION['Usuario']['id'], id =>'user_id' );
$items[] = array('text'=>'Titulo', 'type'=>'text', 'name'=>'entity[titulo]', 'value'=> $data['titulo'], id =>'titulo', 'class' => 'col-md-6');
$items[] = array('text'=>'Subtitulo', 'type'=>'text', 'name'=>'entity[subtitulo]', 'value'=> $data['subtitulo'], id =>'subtitulo', 'class' => 'col-md-6');
//////////////////////////////////////////////////////////////////////////////////////////////////////////Categorias
$categorias = array();
$extraConditions = array();
$extraConditions[] = array('condition'=>'parent_id = 0 OR parent_id IS NULL', 'condition_values'=>array() );
$results = DB_INTERFACE_Select('categoria',array('*'), $extraConditions, 'nombre ASC', 1, -1); //carga las categorias padre
$htmlSelect = '<div class="col-md-6">
							<label class="control-label">Categoria</label>
							<select name="entity[categoria_id]" class="form-control">
							<option>Sin categoria</option>';
foreach($results as $result){
	
	$extraConditions = array();	
	$extraConditions[] = array('condition'=>'parent_id = %s', 'condition_values'=>array($result['id']) );		
	$results2 = DB_INTERFACE_Select('categoria',array('*'), $extraConditions, 'nombre ASC', 1, -1); //carga todas las categorias hijas agrupadas por categoria padre
	
	//$htmlSelect .= '<optgroup label="'.$result['nombre'].'">'; //carga el nombre de la categoria padre como opcion de grupo en el select
	$selected = $data['categoria_id'] == $result['id'] ? 'selected="selected"' : '';
	$htmlSelect .= '<option value="'.$result['id'].'" '.$selected.'>'.$result['nombre'].'</option>';
	
	$acOpGp = false;
	foreach($results2 as $result2){
		
		$extraConditions = array();		
		$extraConditions[] = array('condition'=>'parent_id = %s', 'condition_values'=>array($result2['id']) );
		$results3 = DB_INTERFACE_Select('categoria',array('*'), $extraConditions, array( 'order'=>'%s ASC', 'order_values'=>array('posicion') ),1, -1); //carga categorias hijo de categorias padre del segundo nivel para formar un tercero , hacer subcategorias de las categorias hijo
		
		if(empty($results3)){
			$selected = $data['categoria_id'] == $result2['id'] ? 'selected="selected"' : ''; //precarga la categoria seleccinada asociada al producto
			$result2['nombre'] = $acOpGp ? ('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' . $result2['nombre']) : $result2['nombre'];
			$htmlSelect .= '<option value="'.$result2['id'].'" '.$selected.'>'.$result2['nombre'].'</option>';
		}else{
			$htmlSelect .= '<optgroup label="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$result2['nombre'].'">'; //imprime las subcategorias de categorias hijo
			foreach($results3 as $result3){
				$selected = $data['categoria_id'] == $result3['id'] ? 'selected="selected"' : '';
				$htmlSelect .= '<option value="'.$result3['id'].'" '.$selected.'>&nbsp;&nbsp;&nbsp;'.$result3['nombre'].'</option>';
			}
			$htmlSelect .= '</optgroup>';
			$acOpGp = true;
		}
	}
	$htmlSelect .= '</optgroup>';
}
$htmlSelect .= '</select>
			</div>';
$items[] = array('text'=>'Categoria', 'type'=>'text_plain','value'=> $htmlSelect);
//////////////////////////////////////////////////////////////////////////////////////////////////Fin de categorias
$items[] = array('text'=>'Tags', 'type'=>'text', 'name'=>'entity[tags]', 'value'=> $data['tags'], id =>'tags', 'class' => 'col-md-6');
$items[] = array('text'=>'Fecha de Captura', 'type'=>'text', 'name'=>'entity[fecha]', 'value'=> $data['fecha'], id =>'fecha','class' => 'col-md-6');
$items[] = array('text'=>'Hora de Captura', 'type'=>'text', 'name'=>'entity[hora]', 'value'=> $data['hora'], id =>'hora','class' => 'col-md-6');
$items[] = array('text'=>'Video', 'type'=>'text', 'name'=>'entity[video]', 'value'=> $data['video'], id =>'video', 'class' => 'col-md-6');

$items[] = array('text'=>'Publicado por', 'type'=>'text', 'name'=>'entity[publicado]', 'value'=> $data['publicado'], id =>'publicado', 'class' => 'col-md-6');

$items[] = array('text'=>'Imagen (620 × 413 píxeles)', 'type'=>'file', 'name'=>'entity[imagen]', 'value'=> $data['imagen'], id =>'imagen', 'class' => 'col-md-6');
$items[] = array('text'=>'Imagenes (Selcciona varias usando << ctrl+clic >>, Imagen, 620 × 413 píxeles como mínimo)', 'type'=>'file-multiple', 'name'=>'file_array[]', 'value'=> $data['imagen'], id =>'imagenes', 'class' => 'col-md-6', 'seccion'=>'blog','registro_id' => $data['id']);

$items[] = array('text'=>'Contenido', 'type'=>'textarea', 'name'=>'entity[contenido]', 'value'=> $data['contenido'], id =>'contenido','class' => 'col-md-6','style'=>'margin-bottom:10px; height: 258px;');


$items[] = array('text'=>'Status?', 'type'=>'select', 'options'=>array('Activo'=>'Activo','Inactivo'=>'Inactivo'),'name'=>'entity[status]', 'value'=> $data['status'], id =>'status','class' => 'col-md-6 selectContainer');
$form['items'] = $items;
$header_title = $cmd == 'add' ? 'Agregar Blog' :  'Editar Blog';
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
