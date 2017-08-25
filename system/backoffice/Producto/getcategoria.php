<?php

require_once('../../lib.php');
require_once('../../lib/controller.php');

$ca = empty($ca) ? array() : $ca;



$res = $_GET['valor'];
$form2 = array();
$items2 = array();
$form2['title'] = 'Caracteristicas adicionales ';
$categorias4 = array( );
$categorias4[] = 'Seleccionada como Categoria Secundaria';


$extraConditions4 = array();
   $extraConditions4[] = array('condition'=>'id = %s', 'condition_values'=>array($res) );
   $results4 = DB_INTERFACE_Select('categoria',array('*'), $extraConditions4,
         array( 'order'=>'%s ASC', 'order_values'=>array('posicion') ),
      1, -1);
   
 foreach($results4 as $result4){
 }

$categoria_producto3 = array();
$extraConditions3 = array();
$a = array();
 $extraConditions3[] = array('condition'=>'id_categoria = %s', 'condition_values'=>array($result4['parent_id']) );
                       $result3 = DB_INTERFACE_Select('catalogo',array('*'), $extraConditions3,
                       array( 'order'=>'%s ASC' ),
                       1, -1);

                         foreach($result3 as $results3){
                         if($results3['id_categoria'] == $result4['parent_id']){
                    

                         $items2[] = array('text'=>$results3['atributo'], 'type'=>$results3['type'],  'name'=>'entity2['.$results3['id_catalogo'].']', 'value'=> $data[''], id =>$results3['atributo'], 'class' => 'col-md-6');

                                      }
                                 }

  $categoria_producto32 = array();
$extraConditions32 = array();
$a2 = array();
 $extraConditions32[] = array('condition'=>'id_categoria = %s', 'condition_values'=>array($res));
                       $result32 = DB_INTERFACE_Select('catalogo',array('*'), $extraConditions32,
                       array( 'order'=>'%s ASC' ),
                       1, -1);

                         foreach($result32 as $results32){
                         if($results32['id_categoria'] == $res){
                    

                         $items2[] = array('text'=>$results32['atributo'], 'type'=>$results32['type'],  'name'=>'entity2['.$results32['id_catalogo'].']', 'value'=> $data[''], id =>$results32['atributo'], 'class' => 'col-md-6');

                                      }
                                 }



      
                                   
                                 $form2['items'] = $items2;
                                 displayForm( $form2);
?>

