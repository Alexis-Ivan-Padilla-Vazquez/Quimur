<?php
require_once('../lib.php');
require_once("pasaporte.php");
require_once('../lib/controller.php');

$args = array();
$args2 = array();

//Archivo Controlador de Clase. 
//Obtiene los parametros de cotrolador
//tambien procesa resultados de ejecucion recibidos de mensajes del controlador
$args['controller_file'] = 'Categoria.php';

$args['view_dir'] = 'Categoria/';
$args['view_file'] = '';

$args['table_name_list'] = 'categoria';
$args['table_name'] = 'categoria';
$args['table_id'] = 'id';

$args['model_search_extra_conditions'] =array();
$args['model_select_fields'] = array('*');
$args['model_search_fields'] = array('nombre');

//Obtiene todos los registros (-1 Todos los registros)
$_REQUEST['k'] = -1;


$entity2 =  $_REQUEST['entity2'];

    $args2['entity2'] = $entity2;

    //debug( $args2['entity2']);

$args2['controller_file'] = 'Categoria.php';

$args2['view_dir'] = 'Categoria/';
$args2['view_file'] = '';

$args2['table_name_list'] = 'catalogo';
$args2['table_name'] = 'catalogo';
$args2['table_id'] = 'id';

$args2['model_search_extra_conditions'] =array();
$args2['model_select_fields'] = array('*');
$args2['model_search_fields'] = array('nombre');
      



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
         $result = uploadFile( 'imagen', getImgDir('blog','imagen',0,0,false) . $img_name ,$tiposValidos );

         if($result > 0){
            $entity['imagen'] = $img_name;
         }
         
      }
      $args['entity'] = $entity;

   break;
   default:break;
}

Controller_Execute($cmd, $args);
?>
