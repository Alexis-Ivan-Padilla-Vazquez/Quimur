<?php
//<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
require_once('../lib.php');
require_once("pasaporte.php");


$args = array();

//Archivo Controlador de Clase. 
//Obtiene los parametros de cotrolador
//tambien procesa resultados de ejecucion recibidos de mensajes del controlador
$args['controller_file'] = 'Producto.php';

$args['view_dir'] = 'Producto/';
$args['view_file'] = '';

$args['table_name_list'] = 'producto';
$args['table_name'] = 'producto';
$args['table_id'] = 'id';

$args['model_search_extra_conditions'] =array();
$args['model_select_fields'] = array('*');
$args['model_search_fields'] = array('nombre');


 $entity2 =  $_REQUEST['entity2'];

    $args2['entity2'] = $entity2;



//if(!empty($args2['entity2']))
      //{
      $args2['controller_file'] = 'Producto.php';

      $args2['view_dir'] = 'Producto/';
      $args2['view_file'] = '';

      $args2['table_name_list'] = 'relacion';
      $args2['table_name'] = 'relacion';
      $args2['table_id'] = 'id';

      $args2['model_search_extra_conditions'] =array();
      $args2['model_select_fields'] = array('*');
      $args2['model_search_fields'] = array('valor');
      $args2['cmd_show'] = 'productos';
      $args2['seccion_title'] = 'Producto';
      $args2['o'] = 'id DESC';
      //}else{}



$args['cmd_show'] = 'productos';
$args['seccion_title'] = 'Producto';

$args['o'] = 'id DESC';

$_REQUEST['k'] = 60;

$cmd =  $_REQUEST['cmd'];
switch( $cmd ){
   case 'save':
$entity =  $_REQUEST['entity'];


      if( !empty($_FILES['imagen']['name']) ){
         $basename = substr(md5(basename($_FILES['imagen']['name'])),0,5);
         $ext = explode('.',basename($_FILES['imagen']['name']));
         $ext = array_reverse($ext);
         $ext =$ext[0];
         
         $img_name = date('YmdHis') . '_' . $basename .'.'. $ext;

         $tiposValidos = array('jpeg', 'jpg','gif', 'png');
         foreach($tiposValidos as $tipo){
            $tiposValidos[] = strtoupper($tipo);
         }
         $result = uploadFile( 'imagen', getImgDir('producto','imagen',0,0,false) . $img_name ,$tiposValidos );

         if($result > 0){
            $entity['imagen'] = $img_name;
         }
         
      }

 $args['entity'] = $entity;

//debug($args['entity']);

   //($args2);

  //debug($args['entity']);
   //die;
   break;
   default:break;
}
//debug($cmd);
//debug($args);
//die;
Controller_Execute($cmd, $args, $args2);
?>
