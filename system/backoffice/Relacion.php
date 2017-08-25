<?php
require_once('../lib.php');
require_once("pasaporte.php");
require_once('../lib/controller.php');
 $id = $_REQUEST['id'];
 $args = array();



//Archivo Controlador de Clase. 
//Obtiene los parametros de cotrolador
//tambien procesa resultados de ejecucion recibidos de mensajes del controlador
$args['controller_file'] = 'Relacion.php';
$args['view_dir'] = 'Relacion/';
$args['view_file'] = '';
$args['table_name_list'] = 'relacion';
$args['table_name'] = 'relacion';
$args['table_id'] = 'id';
 $args['model_search_extra_conditions'] =array('condition'=>'id_producto ='.$id);
/*if($id == ''){
            $args['model_search_extra_conditions'] =array();
                
             }else{
 $ee[] = array('condition'=>'id = %s', 'condition_values'=>array($id ));
                       $resulta33 = DB_INTERFACE_Select('categoria',array('parent_id'), $ee,
                       array( 'order'=>'%s ASC', 'order_values'=>array('posicion') ),
                       1, -1);

                         foreach($resulta33 as $resultas33){
                         }
         if($resultas33['parent_id'] == 0){
             $args['model_search_extra_conditions'] =array('condition'=>'id_categoria ='.$id);
                
                                           }else{

                                                $args['model_search_extra_conditions'] =array('condition'=>'id_categoria ='.$resultas33['parent_id'] , 'conditionn'=>'id_categoria ='.$id);
                                                }
                  } */
           
                  $args['model_select_fields'] = array('*');
                  $args['model_search_fields'] = array('');

                  //Obtiene todos los registros (-1 Todos los registros)
                  $_REQUEST['k'] = -1;

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
