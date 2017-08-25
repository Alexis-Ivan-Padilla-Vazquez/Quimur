<?php
//controlador juega el papel de controlador y aplication junto con el invocador al controlador
function Controller_Execute($cmd ='', $args=array(), $args2=array()){
$cmd =  empty($cmd) ? $_REQUEST['cmd'] : $cmd;
$args['entity'] = empty($args['entity']) ? $_REQUEST['entity'] : $args['entity'];
$args2['entity2'] = empty($args2['entity2']) ? $_REQUEST['entity2'] : $args2['entity2'];

$args['view_dir'] = empty($args['view_dir']) ? '' : $args['view_dir'];
$args['view_file'] = empty($args['view_file']) ? '' : $args['view_file'];
$args['table_name'] = empty($args['table_name']) ? '' : $args['table_name'];
$args['table_id'] = empty($args['table_id']) ? '' : $args['table_id'];
$args['table_name_list'] = empty($args['table_name_list']) ? '' : $args['table_name_list'];
$args['model_select_fields'] = empty($args['model_select_fields']) ? array() : $args['model_select_fields'];
$args['model_search_fields'] = empty($args['model_search_fields']) ? array() : $args['model_search_fields'];
$args['model_search_hidden_fields'] =
empty($args['model_search_hidden_fields']) ? array() : $args['model_search_hidden_fields'];

    // if(!empty($args2['entity2']))
     // {
     $args2['view_dir'] = empty($args2['view_dir']) ? '' : $args2['view_dir'];
     $args2['view_file'] = empty($args2['view_file']) ? '' : $args2['view_file'];
     $args2['table_name'] = empty($args2['table_name']) ? '' : $args2['table_name'];
     $args2['table_id'] = empty($args2['table_id']) ? '' : $args2['table_id'];
     $args2['table_name_list'] = empty($args2['table_name_list']) ? '' : $args2['table_name_list'];
     $args2['model_select_fields'] = empty($args2['model_select_fields']) ? array() : $args2['model_select_fields'];
     $args2['model_search_fields'] = empty($args2['model_search_fields']) ? array() : $args2['model_search_fields'];
     $args2['model_search_hidden_fields'] =
     empty($args2['model_search_hidden_fields']) ? array() : $args2['model_search_hidden_fields'];
     // }else{}
switch( $cmd ){
   case 'delete':
      require_once("pasaporte.php");
      $id =  $_REQUEST['id'];

      DB_INTERFACE_Delete($args['table_name'], $args['table_id'], $id);
      DB_INTERFACE_Delete($args2['table_name'], 'id_producto', $id);

       $_REQUEST['cmd'] = '';
       $_REQUEST['msj'] = '2';
       include($args['controller_file']);
      //die();
   break;

   case 'save':
      require_once("pasaporte.php");
      $fieldIds = array();
      $args['model_select_fields'] = array();
      $fieldIds[$args['table_id']] = $args['entity'][$args['table_id']];

      DB_INTERFACE_Save( $args['table_name'], $args['entity'] , $fieldIds  );
       $_REQUEST['cmd'] = '';
       $_REQUEST['msj'] = '1';
       include($args['controller_file']);



              if ($args2['table_name'] == 'relacion') {
             //funcion para obtener el id
              $rs = mysql_query("SELECT @@identity AS id");
                    if ($row = mysql_fetch_row($rs)) {
                    $id = trim($row[0]);
                    }
                    if($id == 0){
                /////////////7
                ///////////////////////////funcion para convertir a entero
                $num = (int)$fieldIds['id'];
                //////////////////////////////77
                $fieldIds2 = array();
                $args2['model_select_fields'] = array();
                $fieldIds2[$args2['table_id']] = $args2['entity2'][$args2['table_id']];
                  DB_INTERFACE_Delete($args2['table_name'], 'id_producto',$num );

                 foreach($args2['entity2'] as $k => $v){

                     $valores = array('id_producto' =>$num, 'id_catalogo' =>$k, 'valor' =>$v);
                     DB_INTERFACE_Save( $args2['table_name'], $valores, $fieldIds2 );
                                                         }
                    }else{
                          $fieldIds2 = array();
                      $args2['model_select_fields'] = array();
                      $fieldIds2[$args2['table_id']] = $args2['entity2'][$args2['table_id']];

                        foreach($args2['entity2'] as $k => $v){

                           $valores = array('id_producto' =>$id, 'id_catalogo' =>$k, 'valor' =>$v);
                           DB_INTERFACE_Save( $args2['table_name'], $valores, $fieldIds2 );
                                                               }
                           }
                            //DB_INTERFACE_Save( $args2['table_name'], $valores, $fieldIds2 );

                                 }

                                 /*if ($args2['table_name'] == '') {

                                       $rs = mysql_query("SELECT @@identity AS id");
                                                if ($row = mysql_fetch_row($rs)) {
                                                $id = trim($row[0]);
                                                }
                                                if($id == 0){
                                            /////////////7
                                            ///////////////////////////funcion para convertir a entero
                                            $num = (int)$fieldIds['id'];
                                            //////////////////////////////77
                                            $fieldIds2 = array();
                                            $args2['model_select_fields'] = array();
                                            $fieldIds2[$args2['table_id']] = $args2['entity2'][$args2['table_id']];
                                              DB_INTERFACE_Delete($args2['table_name'], 'id_producto',$num );

                                                 foreach($args2['entity2'] as $k => $v){

                                                 $valores = array('id_producto' =>$num, 'id_catalogo' =>$k, 'valor' =>$v);
                                                 DB_INTERFACE_Save( $args2['table_name'], $valores, $fieldIds2 );
                                                                       }
                                                  }else{
                                                  $fieldIds2 = array();
                                                  $args2['model_select_fields'] = array();
                                                  $fieldIds2[$args2['table_id']] = $args2['entity2'][$args2['table_id']];

                                                //////////////////////asignar una nueva llave y valor a un array
                                                  $args2['entity2']['id_categoria'] = $id;
                                                 //array_push($args2['entity2'],'atributo','fdfd');
                                              ////////////////////////////////////////////////
                                                
                                                   DB_INTERFACE_Save( $args2['table_name'], $args2['entity2'], $fieldIds2 );
                                                                       
                                                                           
                                        }
                          }*/
                          
      //die();
   break;
   case 'add':
      require_once("pasaporte.php");
      $data = array();
      $args['view_file'] = !empty( $args['view_file'] ) ? $args['view_file'] : 'edit.php';
      $args['view_file'] = $args['view_dir'] . $args['view_file'];
   break;

   

   case 'edit':
      require_once("pasaporte.php");
      $id = $_REQUEST['id'];
      $where =$args['table_id'] . ' = ' . $id;
      $data = select( $args['table_name'], array( '*' ), $where, '0,1','',false);
       $data = $data[0];
//////////////////////////////////////////
      $w ='id_producto' . ' = ' . $id;
      $dat= select($args2['table_name'], array( 'valor','id_catalogo' ), $w, false);
      $ca = array();
        foreach($dat as  $kss){
            $ca[$kss['id_catalogo']] = $kss['valor'];

        }
       ///debug($ca);
/////////////////////////////////////////
      $args['view_file'] = !empty( $args['view_file'] ) ? $args['view_file'] : 'edit.php';
      $args['view_file'] = $args['view_dir'] . $args['view_file'];

      Controller_AddViewParam('data', $data,'ca', $ca);
   break;



   case 'view':
      $id = $_REQUEST['id'];
      $where =$args['table_id'] . ' = ' . $id;
      $data = select( $args['table_name'],
         array( '*' ),
         $where, '0,1','',false);

      $data = $data[0];

      Controller_AddViewParam('data', $data);
      $args['view_file'] = $args['view_dir'] . $args['view_file'];
   break;
   
   case 'list':
   default:
      if(empty( $args['view_file'] )){
         require_once("pasaporte.php");
      }
      $p = $_REQUEST['p'];
      $k = $_REQUEST['k'];
      
      $_total_data = 0;
      $config = array();
      $args['model_search_extra_conditions'] = empty($args['model_search_extra_conditions']) ? array() : $args['model_search_extra_conditions'];
      
      $config['p'] =!is_numeric($_REQUEST['p']) || $_REQUEST['p'] < 1 ? 1 : $_REQUEST['p'];
      $config['k'] =!is_numeric($_REQUEST['k']) || $_REQUEST['k'] < -1 ? 10 : $_REQUEST['k'];
      
      
      $config['q'] =$_REQUEST['q'];
      $config['o'] =$_REQUEST['o'];
      $config['addhiddenFields'] = empty($args['model_search_hidden_fields']) ? array() : $args['model_search_hidden_fields'];
      $where = '';
      
      $order = empty($order) ? $config['o'] : $order;
      
      if( !empty($config['q']) || !empty($args['model_search_extra_conditions']) ){
         $displayAnd = false;
         
         if(!empty($config['q'])){
            if( $displayAnd ){
               $where .= ' AND ';
            }else{$displayAnd = true;}
            $where .= ' ( ';
            
            
            if(!empty($args['model_search_match'])){
               $where .= ' MATCH('.$args['model_search_match'].') AGAINST ("'.$config['q'].'" IN BOOLEAN MODE)';
            }else{
               if( !empty($args['model_search_fields']) && !empty($config['q']) ){
                  
                  
                  $displayOr = false;
                  foreach($args['model_search_fields'] as $searchField){
                     if( $displayOr ){
                        $where .= ' OR ';
                     }else{$displayOr = true;}
                     
                     $where .= ' (' . $searchField . ' like "%' . $config['q'] . '%" )';
                  }
               }
            }
            $where .= ' ) ';
         }
         
         
         foreach($args['model_search_extra_conditions'] as $extraCondition){
            if( $displayAnd ){
               $where .= ' AND ';
            }else{$displayAnd = true;}
            
            $where .= ' ( ' . $extraCondition . ' ) ';
         }
      }
      
      //debug($where);
      
      if( $config['k'] >= 0 ){
         $limit = (($config['p']-1) * $config['k']) . ',' . $config['k'];
      }
      $args['table_name'] = empty($args['table_name_list']) ? $args['table_name'] : $args['table_name_list'];
      
      $data = select($args['table_name'], $args['model_select_fields']  ,$where,$limit,$order,false);
      $_total_data = select($args['table_name'],$args['model_select_fields']  ,$where,$limit,$order,true);
      
      Controller_AddViewParam('_total_data', $_total_data);
      Controller_AddViewParam('config', $config);
      Controller_AddViewParam('data', $data);
      
      $args['view_file'] = !empty( $args['view_file'] ) ? $args['view_file'] : 'list.php';
      $args['view_file'] = $args['view_dir'] . $args['view_file'];      
   break;
   

   case 'add_pics':
      require_once("pasaporte.php");
      $data = array();
      $args['view_file'] = !empty( $args['view_file'] ) ? $args['view_file'] : 'add_pics.php';
      $args['view_file'] = $args['view_dir'] . $args['view_file'];
   break;

}
include( $args['view_file'] );
}
function Controller_AddViewParam($name, $value, $nam, $val){
   static $params = array();
   static $param = array();
   $params[$name] = $value;
  $param[$nam] = $val;
  //debug($param[$nam]);
   return $params;
   return $param;

}
function Controller_GetViewParams(){
   $p = Controller_AddViewParam('','');
   unset($p['']);
   return $p;
}
?>
