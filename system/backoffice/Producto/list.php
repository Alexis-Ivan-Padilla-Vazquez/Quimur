<?php
$_total_data = empty($_total_data) ?  0 : $_total_data;
$config = empty($config) ? array() : $config;
$data = empty($data) ? array() : $data;

$npage = !is_numeric($_REQUEST['p']) ? 1 : $_REQUEST['p'];

$buttons =array();
$buttons[] = array(
   'alt'=>'Atributos', 'title'=>'Atributos', 'img' => 'img/contenido.png',
   'href' => '?sec=Relacion&id=[id]',
   'hrefReplaceArr' => 
      array( 
         array('search' => '[id]', 'field_replace' => 'id' )
      )
);
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
      if(empty($imagen['imagen'])){
      return '<img src="../../system/files/images/tache.png" style="width:30px;" />';
   }else{
   return '<img src="../../system/files/images/'.$imagen['imagen'].'" style="width:50px;" />';
 }
}

function categoria($categoria){
   $categoria = DB_INTERFACE_LoadById('categoria','id',$categoria['categoria_producto_id']);
   return $categoria['nombre'];
}

function marca($marca){
   $marca = DB_INTERFACE_LoadById('marca','id',$marca['marca_id']);
   return $marca['nombre'];
}

function usuario($usuario){
   $usuario = DB_INTERFACE_LoadById('usuario','id',$usuario['user_id']);
   return $usuario['nombre']." ".$usuario['apellidos'];
}

$config['callFunctions'] = array('imagen' =>'imagen','categoria_producto_id' =>'categoria','user_id' =>'usuario','marca_id' =>'marca');

$config['actionButtons'] = $buttons;
$config['renameColumns'] = array('id' =>'ID','producto' =>'Producto','imagen'=>'Imagen','costo_real'=>'Costo','precio_venta'=>'Precio','user_id'=>'Usuario','in_front'=>'¿Home?','marca_id'=>'Marca','status'=>'Status','categoria_producto_id'=>'Categpría'); 
$config['hiddenColumns'] = array('descripcion'); 

$header_title = 'Productos';

if( $_REQUEST['msj'] == 1 ){
   $header_msj_class = 'ok msj';
   $header_msj = 'Registro Producto Guardado';
}
if( $_REQUEST['msj'] == 2 ){
   $header_msj_class = 'ok msj';
   $header_msj = 'Registro Producto Eliminado';
}
?>
   <div class="row gutter">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
         <div class="panel panel-light">
               <div class="panel-body">
                  <div class="table-responsive">
               <!--<div  align="right" >
               <a href="main.php?sec=Relacion" class="btn btn-info btn-rounded"> Atributos</a>
               </div>-->


                     <?php displayDataTable( $_total_data, $data, $config);  ?>

                  </div>
               </div>
         </div>
      </div>
   </div>


