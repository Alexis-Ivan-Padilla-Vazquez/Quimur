<?php
$npage = !is_numeric($_REQUEST['p']) ? 1 : $_REQUEST['p'];

$data = empty($data) ? array() : $data;

$form = array();
$form['title'] = 'Informacion de Producto';
$items = array();



$items[] = array('type'=>'hidden', 'name'=>'entity[id]', 'value'=> $data['id'], id =>'id' );
$items[] = array('type'=>'hidden', 'name'=>'entity[user_id]', 'value'=> $_SESSION['Usuario']['id'], id =>'user_id' );
$items[] = array('text'=>'Producto', 'type'=>'text', 'name'=>'entity[producto]', 'value'=> $data['producto'], id =>'producto', 'class' => 'col-md-6');
$items[] = array('text'=>'Codigo', 'type'=>'text', 'name'=>'entity[codigo]', 'value'=> $data['codigo'], id =>'codigo', 'class' => 'col-md-6');
$items[] = array('text'=>'Costo', 'type'=>'text', 'name'=>'entity[costo_real]', 'value'=> $data['costo_real'], id =>'costo_real', 'class' => 'col-md-6');
$items[] = array('text'=>'Precio', 'type'=>'text', 'name'=>'entity[precio_venta]', 'value'=> $data['precio_venta'], id =>'precio_venta', 'class' => 'col-md-6');

//////////////////////////////////////////////////////////////////////////////////////////////////////////Categoria_productos

/*$categoria_productos = array();
$extraConditions = array();
$extraConditions[] = array('condition'=>'parent_id = 0 ', 'condition_values'=>array() );
$results = DB_INTERFACE_Select('categoria',array('*'), $extraConditions, 'nombre ASC', 1, -1); //carga las categoria_productos padre
$htmlSelect = '<div class="col-md-6">
                     <label class="control-label">Categoria de Producto</label>
                     <select name="entity[id]" class="form-control">
                     <option>Sin categoria de producto</option>';
foreach($results as $result){

   $extraConditions = array();   
   $extraConditions[] = array('condition'=>'parent_id = %s', 'condition_values'=>array($result['id']) );
   $results2 = DB_INTERFACE_Select('categoria',array('*'), $extraConditions, 'nombre ASC', 1, -1); //carga todas las categoria_productos hijas agrupadas por categoria_producto padre
   
   $htmlSelect .= '<optgroup label="'.$result['nombre'].'">'; //carga el nombre de la categoria_producto padre como opcion de grupo en el select
   $selected = $data['id'] == $result['id'] ? 'selected="selected"' : '';
   $htmlSelect .= '<option value="'.$result['id'].'" '.$selected.'>'.$result['nombre'].'</option>';
   
   $acOpGp = false;
   foreach($results2 as $result2){
      
      $extraConditions = array();      
      $extraConditions[] = array('condition'=>'parent_id = %s', 'condition_values'=>array($result2['id']) );
      $results3 = DB_INTERFACE_Select('categoria',array('*'), $extraConditions, array( 'order'=>'%s ASC', 'order_values'=>array('posicion') ),1, -1); //carga categoria_productos hijo de categoria_productos padre del segundo nivel para formar un tercero , hacer subcategoria_productos de las categoria_productos hijo
      
      if(empty($results3)){
         $selected = $data['id'] == $result2['id'] ? 'selected="selected"' : ''; //precarga la categoria_producto seleccinada asociada al producto
         $result2['nombre'] = $acOpGp ? ('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' . $result2['nombre']) : $result2['nombre'];
         $htmlSelect .= '<option value="'.$result2['id'].'" '.$selected.'>'.$result2['nombre'].'</option>';
      }else{
         $htmlSelect .= '<optgroup label="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$result2['nombre'].'">'; //imprime las subcategoria_productos de categoria_productos hijo
         foreach($results3 as $result3){
            $selected = $data['id'] == $result3['id'] ? 'selected="selected"' : '';
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
$items[] = array('text'=>'Categoria de producto', 'name'=>'entity[categoria]', id =>'categoria', 'type'=>'text_plain', 'value'=> $htmlSelect);*/

$categoria_productos = array();
$extraConditions = array();

$extraConditions[] = array('condition'=>'parent_id = 0 ', 'condition_values'=>array() );
$results = DB_INTERFACE_Select('categoria',array('*'), $extraConditions, 'nombre ASC', 1, -1);

$categoria_productos[] = 'Seleccionada como Categoria producto Principal';

foreach($results as $result){
   $categoria_productos[$result['id']] = $result['nombre'];

///funcion para poder ver sus subcategorias
   $extraConditions = array();
   $extraConditions[] = array('condition'=>'parent_id = %s', 'condition_values'=>array($result['id']) );
   $results2 = DB_INTERFACE_Select('categoria',array('*'), $extraConditions,
         array( 'order'=>'%s ASC', 'order_values'=>array('posicion') ),
      1, -1);

   foreach($results2 as $result2){
      $categoria_productos[$result2['id']] = '&nbsp;&nbsp;&nbsp;'.$result2['nombre'];

   }
}


$items[] = array('text'=>'Categoria  Principal', 'type'=>'select','options'=>$categoria_productos, 'name'=>'entity[categoria_producto_id]', 'value'=> $data['categoria_producto_id'],'class'=>'col-md-6',  'id'=>"categoria_producto_id");
//////////////////////////////////////////////////////////////////////////////////////////////////Fin de categoria_productos
//////////////////////////////////////////////////////////////////////////////////////////////////////////Marcas



$items[] = array('text'=>'¿In Home?', 'type'=>'select', 'options'=>array('Si'=>'Si','No'=>'No'),'name'=>'entity[in_front]', 'value'=> $data['in_front'], id =>'in_front','class' => 'col-md-6 selectContainer');

$extraConditions = array();



$results = DB_INTERFACE_Select('marca',array('*'), $extraConditions, 'nombre ASC', 1, -1);

$marcas[] = 'Sin Marca';

foreach($results as $result){

$marcas[$result['id']] = $result['nombre'];

}

$items[] = array('text'=>'Marca', 'type'=>'select','options'=>$marcas, 'name'=>'entity[marca_id]', 'value'=> $data['marca_id'], id =>'marca_id','class' => 'col-md-6');


$items[] = array('text'=>'Status?', 'type'=>'select', 'options'=>array('Activo'=>'Activo','Inactivo'=>'Inactivo'),'name'=>'entity[status]', 'value'=> $data['status'], id =>'status','class' => 'col-md-6 selectContainer');
$items[] = array('text'=>'Descripcion', 'type'=>'textarea', 'name'=>'entity[descripcion]', 'value'=> $data['descripcion'], id =>'descripcion', 'class' => 'col-md-6','style'=>'margin-bottom:10px; height: 200px;');

$items[] = array('text'=>'Imagen (620 × 413 píxeles)', 'type'=>'file', 'name'=>'entity[imagen]', 'value'=> $data['imagen'], id =>'imagen', 'class' => 'col-md-6');
$form['items'] = $items;
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

if(!empty($ca))
      {
$ca = empty($ca) ? array() : $ca;

$form2 = array();
$items2 = array();
$form2['title'] = 'Caracteristicas adicionales ';

$c = array();
$e = array();
$eee = array();
$a = array();
$ee = array();
$vv  = $data['categoria_producto_id'];
 $ee[] = array('condition'=>'id = %s', 'condition_values'=>array($vv ));
                       $resulta33 = DB_INTERFACE_Select('categoria',array('parent_id'), $ee,
                       array( 'order'=>'%s ASC', 'order_values'=>array('posicion') ),
                       1, -1);

                         foreach($resulta33 as $resultas33){
                         }


 $e[] = array('condition'=>'id_categoria = %s', 'condition_values'=>array($resultas33['parent_id']) );
                       $resulta3 = DB_INTERFACE_Select('catalogo',array('*'), $e,
                       array( 'order'=>'%s ASC' ),
                       1, -1);

                         foreach($resulta3 as $resultas3){
                         if($resultas3['id_categoria'] == $resultas33['parent_id']){

               $items2[] = array('text'=>$resultas3['atributo'], 'type'=>$resultas3['type'],  'name'=>'entity2['.$resultas3['id_catalogo'].']', 'value'=> $ca[$resultas3['id_catalogo']], id =>$resultas3['atributo'], 'class' => 'col-md-6');
                                      }
                                 }

 $eee[] = array('condition'=>'id_categoria = %s', 'condition_values'=>array($vv) );
                       $resulta3e = DB_INTERFACE_Select('catalogo',array('*'), $eee,
                       array( 'order'=>'%s ASC' ),
                       1, -1);

                         foreach($resulta3e as $resultas3e){
                         if($resultas3e['id_categoria'] == $vv){

               $items2[] = array('text'=>$resultas3e['atributo'], 'type'=>$resultas3e['type'],  'name'=>'entity2['.$resultas3e['id_catalogo'].']', 'value'=> $ca[$resultas3e['id_catalogo']], id =>$resultas3e['atributo'], 'class' => 'col-md-6');
                                      }
                                 }


                                    $form2['items'] = $items2;
}
else{}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

$header_title = $cmd == 'add' ? 'Agregar Producto' :  'Editar Producto';
echo '<div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
         <div class="panel panel-light">
            <div class="panel-body">
                  <form action="" method="post" enctype="multipart/form-data" >';
                  displayForm( $form);
?>
                  <div id='mensaje'>
                  <?php
                  if(!empty($ca))
                  {
                  displayForm( $form2);
                  }
                  ?>
                 </div>
<?php
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




