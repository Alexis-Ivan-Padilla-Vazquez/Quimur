<?php
$npage = !is_numeric($_REQUEST['p']) ? 1 : $_REQUEST['p'];
$data = empty($data) ? array() : $data;
$form = array();
$form['title'] = 'Informacion de Banner';
$items = array();
$items[] = array('type'=>'hidden', 'name'=>'entity[id]', 'value'=> $data['id'], id =>'id' );
$items[] = array('text'=>'Título', 'type'=>'text', 'name'=>'entity[titulo]', 'value'=> $data['titulo'], id =>'titulo', 'class' => 'col-md-12');
$items[] = array('text'=>'Subtítulo', 'type'=>'text', 'name'=>'entity[subtitulo]', 'value'=> $data['subtitulo'], id =>'subtitulo', 'class' => 'col-md-12');
$items[] = array('text'=>'Encabezado', 'type'=>'text', 'name'=>'entity[encabezado]', 'value'=> $data['encabezado'], id =>'encabezado', 'class' => 'col-md-12');
$items[] = array('text'=>'Link', 'type'=>'text', 'name'=>'entity[url]', 'value'=> $data['url'], id =>'url', 'class' => 'col-md-12');
$items[] = array('text'=>'Status?', 'type'=>'select', 'options'=>array('Activo'=>'Activo','Inactivo'=>'Inactivo'),'name'=>'entity[status]', 'value'=> $data['status'], id =>'status','class' => 'col-md-6 selectContainer');
$items[] = array('text'=>'Imagen (Todas las imagenes deben de ser con la medida  3321px X 1262px)', 'type'=>'file', 'name'=>'entity[imagen]', 'value'=> $data['imagen'], id =>'imagen', 'class' => 'col-md-12');
$items[] = array('type'=>'text_plain', 'value'=>'*Imagen no mayor a 1970 × 900 píxeles');


$form['items'] = $items;
$header_title = $cmd == 'add' ? 'Agregar Banner' :  'Editar Banner';
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
